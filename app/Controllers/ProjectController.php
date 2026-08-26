<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Services\ProjectService;
use App\SolucoesDigitais\Middleware\AuthMiddleware;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct()
    {
        $this->projectService = new ProjectService();
    }

    // Listagem de projetos
    public function index(): void
    {
        AuthMiddleware::handle();
        $projetos = $this->projectService->listarTodos();
        $this->view('Admin/projects/index', ['projetos' => $projetos], 'admin');
    }

    // Exibe o formulário de cadastro
    public function criar(): void
    {
        AuthMiddleware::handle();
        $this->view('Admin/projects/create', [], 'admin');
    }

    // Processa os dados recebidos via POST e salva no banco
    public function salvar(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->projectService->salvar($_POST);
            header('Location: /solucaodigital/public/admin/projetos');
            exit;
        }
    }

    // Remove um projeto do banco via ID recebido por GET
    public function excluir(): void
    {
        AuthMiddleware::handle();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            $this->projectService->excluir($id);
        }

        header('Location: /solucaodigital/public/admin/projetos');
        exit;
    }

    // Carrega a tela com as informações atuais preenchidas
    public function editar(): void
    {
        AuthMiddleware::handle();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $projeto = $this->projectService->buscarPorId($id);

        if (!$projeto) {
            header('Location: /solucaodigital/public/admin/projetos');
            exit;
        }

        $this->view('Admin/projects/edit', ['projeto' => $projeto], 'admin');
    }

    // Processa as alterações enviadas via POST
    public function atualizar(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->projectService->atualizar($_POST);
            header('Location: /solucaodigital/public/admin/projetos');
            exit;
        }
    }
}
