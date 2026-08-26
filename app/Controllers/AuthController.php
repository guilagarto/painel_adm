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
        if (!isset($_SESSION)) { session_start(); }

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        // Verifica se o usuário existe e se a senha bate com o hash criptografado
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            header('Location: /solucaodigital/public/admin');
            exit;
        }

        // Se falhar, recarrega a tela passando a mensagem de erro
        $this->view('Public/login', ['erro' => 'E-mail ou senha incorretos.'], 'main');
    }

    // Faz o logout do sistema
    public function logout(): void
    {
        if (!isset($_SESSION)) { session_start(); }
        session_unset();
        session_destroy();

        header('Location: /solucaodigital/public/login');
        exit;
    }
}
