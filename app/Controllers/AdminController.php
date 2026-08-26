<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Services\AdminService;
use App\SolucoesDigitais\Middleware\AuthMiddleware; // Importamos o guarda aqui

class AdminController extends Controller
{
    private AdminService $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function dashboard(): void
    {
        // O Middleware roda aqui! Se não estiver logado, ele barra e joga pro login
        AuthMiddleware::handle();

        // Se passar pelo Middleware, o código continua normalmente abaixo:
        $dados = $this->adminService->getDashboardStats();

        $this->view('Admin/dashboard', $dados, 'admin');
    }
}
