<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Core\Database;

class AuthController extends Controller
{
    // Exibe a tela de login
    public function mostrarLogin(): void
    {
        // Se o usuário já estiver logado, manda direto pro admin
        if (!isset($_SESSION)) { session_start(); }
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /solucaodigital/public/admin');
            exit;
        }

        $this->view('Public/login', [], 'main');
    }

    // Processa o envio do formulário de login
     public function logar(): void
    {
        // ... (sua lógica padrão de validação de e-mail e password_verify continua igual em cima)

        // Se a senha bater com o banco, loga o usuário:
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        // CORRIGIDO: Redireciona de forma limpa para o dashboard online
        header('Location: /admin');
        exit;
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_destroy();

        // CORRIGIDO: Ao deslogar na produção, joga o usuário de volta para o login limpo da Hostinger
        header('Location: /login');
        exit;
    }
}
