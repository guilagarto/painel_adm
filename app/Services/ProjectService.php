<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class ProjectService
{
    /**
     * Busca todos os projetos cadastrados no banco de dados.
     */
    public function listarTodos(): array
    {
        $db = Database::getConnection();
        $query = $db->query("SELECT id, nome, cliente, status, data_entrega FROM projetos ORDER BY id DESC");
        return $query->fetchAll();
    }
        /**
     * Insere um novo projeto na base de dados de forma protegida.
     */
    public function salvar(array $dados): bool
    {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO projetos (nome, cliente, status, data_entrega) 
                VALUES (:nome, :cliente, :status, :data_entrega)";
                
        $stmt = $db->prepare($sql);
        
        return $stmt->execute([
            'nome'         => trim($dados['nome']),
            'cliente'      => trim($dados['cliente']),
            'status'       => $dados['status'],
            'data_entrega' => !empty($dados['data_entrega']) ? $dados['data_entrega'] : null
        ]);
    }
        /**
     * Exclui um projeto do banco de dados pelo ID.
     */
    public function excluir(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM projetos WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
        /**
     * Busca um único projeto pelo seu ID.
     */
    public function buscarPorId(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nome, cliente, status, data_entrega FROM projetos WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch();
        return $resultado ? $resultado : null;
    }

    /**
     * Atualiza os dados de um projeto existente no banco.
     */
    public function atualizar(array $dados): bool
    {
        $db = Database::getConnection();
        $sql = "UPDATE projetos 
                SET nome = :nome, cliente = :cliente, status = :status, data_entrega = :data_entrega 
                WHERE id = :id";
                
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'id'           => (int)$dados['id'],
            'nome'         => trim($dados['nome']),
            'cliente'      => trim($dados['cliente']),
            'status'       => $dados['status'],
            'data_entrega' => !empty($dados['data_entrega']) ? $dados['data_entrega'] : null
        ]);
    }



}
