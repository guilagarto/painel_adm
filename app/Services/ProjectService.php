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
 /**
     * Insere um novo projeto mapeando os dados operacionais e financeiros.
     */
    public function salvar(array $dados): bool
    {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO projetos (nome, cliente, valor_contrato, valor_recebido, parcelas, status, prazo_final) 
                VALUES (:nome, :cliente, :valor_contrato, :valor_recebido, :parcelas, :status, :prazo_final)";
                
        $stmt = $db->prepare($sql);
        
        return $stmt->execute([
            'nome'           => trim($dados['nome']),
            'cliente'        => trim($dados['cliente']),
            'valor_contrato' => (float)$dados['valor_contrato'],
            'valor_recebido' => (float)$dados['valor_recebido'],
            'parcelas'       => (int)$dados['parcelas'],
            'status'         => $dados['status'],
            'prazo_final'    => !empty($dados['prazo_final']) ? $dados['prazo_final'] : null
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
    /**
     * Busca um único projeto contendo todas as variáveis financeiras para edição.
     */
    public function buscarPorId(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nome, cliente, valor_contrato, valor_recebido, parcelas, status, prazo_final FROM projetos WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch();
        return $resultado ? $resultado : null;
    }

    /**
     * Realiza o update dos dados e processa baixas financeiras no MySQL.
     */
    public function atualizar(array $dados): bool
    {
        $db = Database::getConnection();
        $sql = "UPDATE projetos 
                SET nome = :nome, cliente = :cliente, valor_contrato = :valor_contrato, 
                    valor_recebido = :valor_recebido, parcelas = :parcelas, status = :status, prazo_final = :prazo_final 
                WHERE id = :id";
                
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'id'             => (int)$dados['id'],
            'nome'           => trim($dados['nome']),
            'cliente'        => trim($dados['cliente']),
            'valor_contrato' => (float)$dados['valor_contrato'],
            'valor_recebido' => (float)$dados['valor_recebido'],
            'parcelas'       => (int)$dados['parcelas'],
            'status'         => $dados['status'],
            'prazo_final'    => !empty($dados['prazo_final']) ? $dados['prazo_final'] : null
        ]);
    }



}
