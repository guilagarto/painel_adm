<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Core\Database;
use App\SolucoesDigitais\Middleware\AuthMiddleware;

class UserController extends Controller
{
    public function index(): void
    {
        AuthMiddleware::handle();
        
        $db = Database::getConnection();
        $query = $db->query("SELECT id, nome, email, created_at FROM usuarios ORDER BY id DESC");
        $usuarios = $query->fetchAll();

        $this->view('Admin/users/index', ['usuarios' => $usuarios], 'admin');
    }

    public function criar(): void
    {
        AuthMiddleware::handle();
        $this->view('Admin/users/create', [], 'admin');
    }

    public function salvar(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getConnection();
            
            // Criptografia profissional e irreversível da senha informada
            $senhaSegura = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->execute([
                'nome'  => trim($_POST['nome']),
                'email' => trim($_POST['email']),
                'senha' => $senhaSegura
            ]);

            header('Location: /solucaodigital/public/admin/usuarios');
            exit;
        }
    }

    public function excluir(): void
    {
        AuthMiddleware::handle();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        // Impede que o usuário logado delete a si próprio por acidente
        if ($id === (int)$_SESSION['usuario_id']) {
            header('Location: /solucaodigital/public/admin/usuarios');
            exit;
        }

        if ($id > 0) {
            $db = Database::getConnection();
            $stmt = $db->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }

        header('Location: /solucaodigital/public/admin/usuarios');
        exit;
    }
}
