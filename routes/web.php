<?php

use App\SolucoesDigitais\Core\Router;
use App\SolucoesDigitais\Controllers\MarketingController;
use App\SolucoesDigitais\Controllers\AdminController;
use App\SolucoesDigitais\Controllers\AuthController;
use App\SolucoesDigitais\Controllers\ProjectController;
use App\SolucoesDigitais\Controllers\MetricController;
use App\SolucoesDigitais\Controllers\ReportController;

$router = new Router();
// --- ÁREA PÚBLICA (INSTITUCIONAL 80u80) ---
$router->get('/', [MarketingController::class, 'index']);
$router->get('/solucoes', [MarketingController::class, 'solucoes']);
$router->get('/cases', [MarketingController::class, 'cases']);
$router->get('/blog', [MarketingController::class, 'blog']);

// Rota interna do artigo (Registrada de forma estrita e com variação de barra para blindar o 404)
$router->get('/blog/artigo', [MarketingController::class, 'artigo']);
$router->get('/blog/artigo/', [MarketingController::class, 'artigo']);

$router->get('/sobre', [MarketingController::class, 'sobre']);
$router->get('/contato', [MarketingController::class, 'contato']);


// --- ÁREA PÚBLICA ---
$router->get('/', [MarketingController::class, 'index']);
$router->get('/marketing', [MarketingController::class, 'index']);
$router->get('/login', [AuthController::class, 'mostrarLogin']);
$router->post('/login', [AuthController::class, 'logar']);
$router->get('/logout', [AuthController::class, 'logout']);

// --- ÁREA PRIVADA ---
$router->get('/admin', [AdminController::class, 'dashboard']);

// --- GESTÃO DE PROJETOS ---
$router->get('/admin/projetos', [ProjectController::class, 'index']);
$router->get('/admin/projetos/novo', [ProjectController::class, 'criar']);
$router->post('/admin/projetos/salvar', [ProjectController::class, 'salvar']);
$router->get('/admin/projetos/editar', [ProjectController::class, 'editar']);
$router->post('/admin/projetos/atualizar', [ProjectController::class, 'atualizar']);
$router->get('/admin/projetos/excluir', [ProjectController::class, 'excluir']);

// --- GESTÃO DE MÉTRICAS POR PROJETO ---
$router->get('/admin/metricas', [MetricController::class, 'index']);
$router->get('/admin/metricas/ajustar', [MetricController::class, 'editar']); 
$router->post('/admin/metricas/salvar', [MetricController::class, 'salvar']); 

// --- CENTRAL DE RELATÓRIOS (PDF & UPLOADS) ---
$router->get('/admin/relatorios', [ReportController::class, 'index']);
$router->get('/admin/relatorios/novo', [ReportController::class, 'criar']);
$router->post('/admin/relatorios/salvar', [ReportController::class, 'salvar']);
$router->get('/admin/relatorios/excluir', [ReportController::class, 'excluir']);

// Rota de Exportação do PDF corrigida e padronizada com o seu roteador

// Blindagem tripla para capturar qualquer variação gerada pelo seu Router no XAMPP:
$router->get('/admin/relatorios/pdf', [ReportController::class, 'exportarPdf']);
$router->get('/admin/relatorios/pdf/', [ReportController::class, 'exportarPdf']);
$router->get('/relatorios/pdf', [ReportController::class, 'exportarPdf']);

// --- GESTÃO DE USUÁRIOS ADMINISTRATIVOS ---
$router->get('/admin/usuarios', [\App\SolucoesDigitais\Controllers\UserController::class, 'index']);
$router->get('/admin/usuarios/novo', [\App\SolucoesDigitais\Controllers\UserController::class, 'criar']);
$router->post('/admin/usuarios/salvar', [\App\SolucoesDigitais\Controllers\UserController::class, 'salvar']);
$router->get('/admin/usuarios/excluir', [\App\SolucoesDigitais\Controllers\UserController::class, 'excluir']);

// --- PAINEL DE CONTROLE DO BLOG ---
$router->get('/admin/blog', [\App\SolucoesDigitais\Controllers\AdminBlogController::class, 'index']);
$router->get('/admin/blog/novo', [\App\SolucoesDigitais\Controllers\AdminBlogController::class, 'criar']);
$router->post('/admin/blog/salvar', [\App\SolucoesDigitais\Controllers\AdminBlogController::class, 'salvar']);
$router->get('/admin/blog/excluir', [\App\SolucoesDigitais\Controllers\AdminBlogController::class, 'excluir']);
$router->get('/blog', [MarketingController::class, 'blog']);
$router->get('/blog/artigo', [MarketingController::class, 'artigo']); // Nova rota interna registrada!

return $router;
