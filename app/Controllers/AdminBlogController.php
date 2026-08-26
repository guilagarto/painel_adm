<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Middleware\AuthMiddleware;
use App\SolucoesDigitais\Services\SiteService;

class AdminBlogController extends Controller
{
    private SiteService $siteService;

    public function __construct()
    {
        $this->siteService = new SiteService();
    }

    // Listagem de posts dentro do painel administrativo
    public function index(): void
    {
        AuthMiddleware::handle();
        $posts = $this->siteService->obterPostsRecentes(50); // Traz até 50 artigos para gerenciar
        $this->view('Admin/blog/index', ['artigos' => $posts], 'admin');
    }

    // Formulário de criação de novo post
    public function criar(): void
    {
        AuthMiddleware::handle();
        $this->view('Admin/blog/create', [], 'admin');
    }

    // Processa a publicação via POST
    public function salvar(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->siteService->salvarPost($_POST);
            header('Location: /solucaodigital/public/admin/blog');
            exit;
        }
    }

    // Deleta o post
    public function excluir(): void
    {
        AuthMiddleware::handle();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $this->siteService->excluirPost($id);
        }

        header('Location: /solucaodigital/public/admin/blog');
        exit;
    }
}
