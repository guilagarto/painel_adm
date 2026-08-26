<?php

namespace App\SolucoesDigitais\Middleware;

class AuthMiddleware
{
    /**
     * Verifica se o usuário está autenticado na sessão.
     * Caso não esteja, barra o acesso imediatamente.
     */
    public static function handle(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Se a chave não existir na sessão, joga o invasor para a tela de login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /solucaodigital/public/login');
            exit;
        }
    }
}
