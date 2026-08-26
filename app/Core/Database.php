<?php

namespace App\SolucoesDigitais\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    /**
     * Retorna uma instância única de conexão com o banco de dados.
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            // Configurações padrão do MySQL no XAMPP
            $host = 'localhost';
            $dbname = 'solucaodigital';
            $username = 'root';
            $password = ''; // Padrão do XAMPP é vazio

            try {
                // Monta a string de conexão (DSN) definindo o charset como UTF-8
                $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
                
                self::$instance = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Transforma erros do banco em exceções PHP
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retorna os dados como array associativo padrão
                    PDO::ATTR_EMULATE_PREPARES => false, // Desativa emulação para maior segurança
                ]);
            } catch (PDOException $e) {
                // Se falhar a conexão, interrompe o script amigavelmente para debug
                http_response_code(500);
                die("<h3>Erro de Conexão com o Banco de Dados</h3>" . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
