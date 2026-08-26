<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Core\Database;
use App\SolucoesDigitais\Middleware\AuthMiddleware;

class LeadController extends Controller
{
    // Lista todos os contatos que chegaram pelo formulário do site
    public function index(): void
    {
        AuthMiddleware::handle();
        
        $db = Database::getConnection();
        $query = $db->query("SELECT id, nome, email, telefone, mensagem, status, created_at FROM site_leads ORDER BY id DESC");
        $leads = $query->fetchAll();

        $this->view('Admin/leads/index', ['leads' => $leads], 'admin');
    }

    // Altera o status do lead para "Em Atendimento" ou encerra
    public function atualizarStatus(): void
    {
        AuthMiddleware::handle();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $novoStatus = isset($_GET['status']) ? $_GET['status'] : 'Em Atendimento';

        if ($id > 0) {
            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE site_leads SET status = :status WHERE id = :id");
            $stmt->execute(['status' => $novoStatus, 'id' => $id]);
        }

        header('Location: /solucaodigital/public/admin/leads');
        exit;
    }
}
