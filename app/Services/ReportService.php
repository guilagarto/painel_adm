<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class ReportService
{
    /**
     * Lista apenas os relatórios pertencentes a um projeto específico.
     */
    public function listarRelatoriosPorProjeto(int $projetoId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nome_documento, formato, tamanho, arquivo_path 
                              FROM relatorios WHERE projeto_id = :projeto_id ORDER BY id DESC");
        $stmt->execute(['projeto_id' => $projetoId]);
        return $stmt->fetchAll();
    }

    /**
     * Registra o arquivo vinculando-o ao projeto correto (Mantido para uploads).
     */
    public function salvar(array $dados): bool
    {
        $db = Database::getConnection();
        $sql = "INSERT INTO relatorios (projeto_id, nome_documento, formato, tamanho, arquivo_path) 
                VALUES (:projeto_id, :nome, :formato, :tamanho, :path)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'projeto_id' => (int)$dados['projeto_id'],
            'nome'       => trim($dados['nome_documento']),
            'formato'    => strtoupper($dados['formato']),
            'tamanho'    => $dados['tamanho'],
            'path'       => $dados['arquivo_path']
        ]);
    }

    public function buscarPorId(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT projeto_id, arquivo_path FROM relatorios WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function excluir(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM relatorios WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Gera e força o download de um PDF a partir das métricas calculadas do projeto.
     */
    public function gerarPdfMetricas(string $nomeProjeto, array $metricas): void
    {
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);

        // Estruturação visual do PDF gerencial (Layout folha A4)
        // Corrigido: Aspas simples na tag meta para não quebrar a string PHP
        $html = "
        <html>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> 
            <style>
                body { font-family: Arial, sans-serif; color: #333; margin: 30px; }
                .header { border-bottom: 2px solid #2b6cb0; padding-bottom: 15px; margin-bottom: 30px; }
                .title { font-size: 24px; font-weight: bold; color: #1a202c; }
                .subtitle { font-size: 14px; color: #718096; margin-top: 5px; }
                .grid { width: 100%; border-collapse: collapse; margin-top: 20px; }
                .grid th, .grid td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; }
                .grid th { background-color: #f7fafc; color: #4a5568; text-transform: uppercase; font-size: 12px; }
                .highlight { font-size: 18px; font-weight: bold; color: #2b6cb0; }
                .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 15px; }
            </style>
        </head>
        <body>
            <div class='header'>
                <div class='title'>80u80 Soluções Digitais</div>
                <div class='subtitle'>Relatório Executivo de Performance de Marketing e Vendas</div>
            </div>

            <h2>Projeto: " . htmlspecialchars($nomeProjeto) . "</h2>
            <p>Indicadores consolidados extraídos em tempo real do sistema em " . date('d/m/Y H:i') . ".</p>

            <table class='grid'>
                <thead>
                    <tr>
                        <th>Indicador Chave (KPI)</th>
                        <th>Resultado Obtido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><strong>Total de Visitantes</strong></td><td class='highlight'>{$metricas['visitantes']}</td></tr>
                    <tr><td><strong>Total de Leads Gerados</strong></td><td class='highlight'>{$metricas['leads']}</td></tr>
                    <tr><td>Taxa de Conversão (Visita > Lead)</td><td>{$metricas['taxa_conversao']}</td></tr>
                    <tr><td><strong>Clientes Conquistados</strong></td><td class='highlight'>{$metricas['clientes']}</td></tr>
                    <tr><td>Conversão de Leads em Clientes</td><td>{$metricas['conversao_leads']}</td></tr>
                    <tr><td>Custo por Lead (CPL)</td><td style='color:#e53e3e;font-weight:bold;'>{$metricas['cpl']}</td></tr>
                    <tr><td>Investimento Realizado em Anúncios</td><td>{$metricas['investimento']}</td></tr>
                    <tr style='background-color:#f0fff4;'>
                        <td><strong>Faturamento Bruto Gerado</strong></td>
                        <td style='color:#22543d;font-weight:bold;font-size:20px;'>{$metricas['faturamento']}</td>
                    </tr>
                </tbody>
            </table>

            <div class='footer'>
                &copy; " . date('Y') . " 80u80 Soluções Digitais. Relatório confidencial gerado via Painel Admin.
            </div>
        </body>
        </html>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if (ob_get_length()) ob_end_clean();

        $nomeArquivoClean = strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $nomeProjeto));
        $dompdf->stream("relatorio-metricas-{$nomeArquivoClean}.pdf", ["Attachment" => true]);
        exit;
    }
}
