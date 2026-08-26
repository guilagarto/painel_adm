<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class SiteService
{
    public function obterPostsRecentes(int $limite = 3): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, titulo, resumo, conteudo, created_at FROM blog_posts ORDER BY id DESC LIMIT :limite");
        $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPostPorId(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, titulo, conteudo, created_at FROM blog_posts WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

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

    public function excluirPost(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

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
}
