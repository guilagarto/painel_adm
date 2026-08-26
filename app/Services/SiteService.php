<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class SiteService
{
    /**
     * Retorna os N artigos mais recentes do blog (Home e Listagem).
     */
    public function obterPostsRecentes(int $limite = 3): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, titulo, resumo, conteudo, created_at FROM blog_posts ORDER BY id DESC LIMIT :limite");
        $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca um único post do blog pelo ID para leitura completa.
     */
    public function buscarPostPorId(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, titulo, conteudo, created_at FROM blog_posts WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Cadastra um novo artigo no banco de dados de forma segura.
     */
    public function salvarPost(array $dados): bool
    {
        $db = Database::getConnection();
        $sql = "INSERT INTO blog_posts (titulo, resumo, conteudo) VALUES (:titulo, :resumo, :conteudo)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'titulo'   => trim($dados['titulo']),
            'resumo'   => trim($dados['resumo']),
            'conteudo' => trim($dados['conteudo'])
        ]);
    }

    /**
     * Remove um artigo do blog a partir do ID.
     */
    public function excluirPost(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Retorna o consolidado financeiro limitado aos 10 principais cases de sucesso.
     */
    public function obterCasesSucesso(): array
    {
        $db = Database::getConnection();
        
        $sql = "SELECT p.nome, 
                       SUM(m.visitantes) as visitantes,
                       SUM(m.leads) as leads,
                       SUM(m.clientes) as clientes,
                       SUM(m.faturamento) as faturamento, 
                       SUM(m.investido_anuncios) as investimento 
                FROM projetos p 
                INNER JOIN projeto_metricas m ON p.id = m.projeto_id 
                GROUP BY p.id 
                ORDER BY faturamento DESC 
                LIMIT 10";
                
        return $db->query($sql)->fetchAll();
    }

    /**
     * Salva o lead recebido pelo formulário e dispara as automações de e-mail.
     */
    public function registrarLead(array $dados): bool
    {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO site_leads (nome, email, telefone, mensagem) VALUES (:nome, :email, :telefone, :mensagem)";
        $stmt = $db->prepare($sql);
        $salvou = $stmt->execute([
            'nome'     => trim($dados['nome']),
            'email'    => trim($dados['email']),
            'telefone' => trim($dados['telefone']),
            'mensagem' => trim($dados['mensagem'])
        ]);

        if ($salvou) {
            $emailAdmin = "tanograu99@gmail.com"; 
            $this->enviarNotificacaoAdmin($emailAdmin, $dados);
            $this->enviarBoasVindasUsuario($dados['email'], $dados['nome']);
        }

        return $salvou;
    }

    /**
     * Envia um e-mail interno com os dados do lead para o administrador da agência.
     */
    private function enviarNotificacaoAdmin(string $para, array $lead): void
    {
        $assunto = "🚨 NOVO LEAD CAPTURADO PELO SITE - 80u80";
        
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: Site 80u80 <noreply@80u80.com>\r\n";

        $html = "
        <div style='font-family:Arial,sans-serif;color:#333;padding:20px;max-width:600px;border:1px solid #e2e8f0;border-radius:8px;'>
            <h2 style='color:#1e3a8a;border-bottom:2px solid #d4af37;padding-bottom:10px;'>Novo Lead Comercial</h2>
            <p><strong>Nome:</strong> {$lead['nome']}</p>
            <p><strong>E-mail:</strong> {$lead['email']}</p>
            <p><strong>Telefone:</strong> {$lead['telefone']}</p>
            <div style='background:#f7fafc;padding:15px;border-radius:4px;margin-top:15px;'>
                <strong>Mensagem/Objetivo:</strong><br>
                " . nl2br(htmlspecialchars($lead['mensagem'])) . "
            </div>
        </div>";

        @mail($para, $assunto, $html, $headers);
    }

    /**
     * Envia uma carta de boas-vindas corporativa com a proposta de valor da 80u80 para o usuário.
     */
    private function enviarBoasVindasUsuario(string $para, string $nomeUsuario): void
    {
        $assunto = "Seja bem-vindo à 80u80 Soluções Digitais | Recebemos seu contato";
        
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: 80u80 Soluções Digitais <contato@80u80.com>\r\n";

        $html = "
        <html>
        <body style='font-family:Arial,sans-serif;color:#111;line-height:1.6;background:#f8fafc;padding:20px;'>
            <div style='max-width:600px;margin:0 auto;background:#fff;padding:30px;border-radius:8px;border:1px solid #e2e8f0;border-top:5px solid #1e3a8a;'>
                <h2 style='color:#1e3a8a;margin-top:0;'>Olá, " . htmlspecialchars($nomeUsuario) . ". Seja muito bem-vindo!</h2>
                <p>Confirmamos o recebimento da sua mensagem com sucesso. Um de nossos especialistas em Growth está analisando o escopo do seu projeto neste exato momento para desenharmos um diagnóstico personalizado.</p>
                
                <div style='background:#111;color:#fff;padding:20px;border-radius:6px;margin:25px 0;border-left:4px solid #d4af37;'>
                    <h3 style='color:#d4af37;margin-top:0;font-size:16px;text-transform:uppercase;letter-spacing:0.5px;'>Nossa Proposta de Valor</h3>
                    <p style='margin:10px 0 0 0;font-size:14px;line-height:1.7;'>
                        Na <strong>80u80 Soluções Digitais</strong>, nós não vendemos apenas cliques ou impressões. Nós construímos <strong>motores previsíveis de escala e tração comercial</strong>. Unificamos tráfego de alta performance, redesign de interfaces focadas em experiência (UX/CRO) e automação de funis para converter visitantes anônimos em faturamento real e recorrente para o seu negócio. Nós jogamos o jogo do seu ROI.
                    </p>
                </div>

                <p>Nossa equipe entrará em contato com você via WhatsApp ou e-mail nas próximas duas horas para agendarmos uma reunião estratégica de 15 minutos.</p>
                
                <p style='margin-top:30px;border-top:1px solid #edf2f7;padding-top:15px;font-size:14px;'>
                    Atenciosamente,<br>
                    <strong>Time de Growth e Aquisição | 80u80 Soluções Digitais</strong>
                </p>
            </div>
        </body>
        </html>";

        @mail($para, $assunto, $html, $headers);
    }
} // Chave final da classe perfeitamente fechada aqui!
