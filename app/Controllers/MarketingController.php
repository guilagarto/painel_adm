<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Services\SiteService;

class MarketingController extends Controller
{
    private SiteService $siteService;

    public function __construct()
    {
        $this->siteService = new SiteService();
    }

    // Página Home - Carrega dinamicamente os 3 artigos recentes do blog
    public function index(): void
    {
        $artigos = $this->siteService->obterPostsRecentes(3);
        $this->view('Public/home', ['artigos' => $artigos, 'title' => '80u80 | Agência de Growth Digital'], 'main');
    }

    public function solucoes(): void
    {
        $this->view('Public/solucoes', ['title' => 'Nossas Soluções | 80u80'], 'main');
    }

    // Página de Cases - Carrega projetos com os gráficos de Investimento vs Retorno
    public function cases(): void
    {
        $cases = $this->siteService->obterCasesSucesso();
        $this->view('Public/cases', ['cases' => $cases, 'title' => 'Cases de Sucesso | 80u80'], 'main');
    }

    public function blog(): void
    {
        // Traz todos os posts do banco para listar verticalmente
        $todosPosts = $this->siteService->obterPostsRecentes(50);
        $this->view('Public/blog', ['artigos' => $todosPosts, 'title' => 'Blog | 80u80'], 'main');
    }

    public function artigo(): void
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $post = $this->siteService->buscarPostPorId($id);

        if (!$post) {
            header('Location: /solucaodigital/public/blog');
            exit;
        }

        $this->view('Public/post', ['artigo' => $post, 'title' => $post['titulo'] . ' | 80u80'], 'main');
    }

    public function sobre(): void
    {
        $this->view('Public/sobre', ['title' => 'Sobre Nós | 80u80'], 'main');
    }

    public function contato(): void
    {
        $this->view('Public/contato', ['title' => 'Fale Conosco | 80u80'], 'main');
    }

    /**
     * Processa a submissão do formulário de contato do site público.
     */
    public function enviarContato(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->siteService->registrarLead($_POST);
            
            // Redireciona de volta para a página de contato exibindo o banner de sucesso
            header('Location: /solucaodigital/public/contato?sucesso=1');
            exit;
        }
    }
        public function politicaPrivacidade(): void
    {
        $this->view('Public/politica', ['title' => 'Política de Privacidade | 80u80'], 'main');
    }

    public function termosUso(): void
    {
        $this->view('Public/termos', ['title' => 'Termos de Uso | 80u80'], 'main');
    }

}
