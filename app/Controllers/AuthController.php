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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $db = \App\SolucoesDigitais\Core\Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch();

            if (!$usuario) {
                // Mensagem direta se o e-mail não bater com o phpMyAdmin
                die("<h3>❌ Diagnóstico de Entrada:</h3><p>O e-mail <strong>{$email}</strong> não foi encontrado na tabela 'usuarios' da Hostinger. Verifique letras maiúsculas ou espaços.</p>");
            }

            // Teste de validação do Hash seguro que injetamos
            if (password_verify($senha, $usuario['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                // Se a sessão funcionar, o código vai parar aqui e confirmar o sucesso antes de redirecionar
                echo "<h3>✅ Senha Validada com Sucesso!</h3>";
                echo "<p>Tentando gravar sessão para o usuário ID: " . $_SESSION['usuario_id'] . "</p>";
                echo "<p>Se a página travar aqui, clique no link para forçar a entrada: <a href='/admin'>Acessar Painel Admin</a></p>";
                
                // Redirecionamento padrão
                header('Location: /admin');
                exit;
            } else {
                // Mensagem direta se a senha digitada não bater com a criptografia
                die("<h3>❌ Erro de Criptografia:</h3><p>A senha digitada não corresponde ao código hash salvo no banco de dados da Hostinger.</p>");
            }
        }
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
