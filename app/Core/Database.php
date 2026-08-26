<?php

namespace App\SolucoesDigitais\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                // Detecta automaticamente se o ambiente é Local (XAMPP) ou Produção (Hospedagem)
                if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
                    // Configuração Local do seu Computador (XAMPP)
                    $host = 'localhost';
                    $dbname = 'solucaodigital';
                    $username = 'root';
                    $password = '';
                } else {
                    // 🛑 ALTERE AQUI: Credenciais reais fornecidas pela sua hospedagem na internet
                    $host = 'localhost'; // Quase sempre permanece localhost no servidor
                    $dbname = 'u738627255_marketing';
                    $username = 'u738627255_yato_marketing';
                    $password = 'iGui2026@';
                }

                // String de conexão robusta forçando o charset UTF8 de ponta a ponta
                $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
                
                self::$connection = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

            } catch (PDOException $e) {
                // Mensagem amigável de erro caso a conexão falhe por credenciais incorretas
                die("Erro de conexão com o ecossistema de dados: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
