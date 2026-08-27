<?php

namespace App\SolucoesDigitais\Middleware;

class AuthMiddleware
{
    public static function handle(): void
    {
        // Se a sessão não estiver ativa ou o ID do usuário não existir, bloqueia
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            // CORRIGIDO: Removido o prefixo local. Agora redireciona direto para a raiz da Hostinger
            header('Location: /login');
            exit;
        }
    }
}
