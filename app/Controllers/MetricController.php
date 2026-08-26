<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Middleware\AuthMiddleware;
use App\SolucoesDigitais\Services\MetricsService;

class MetricController extends Controller
{
    private MetricsService $metricService;

    public function __construct()
    {
        $this->metricService = new MetricsService();
    }

    public function index(): void
    {
        AuthMiddleware::handle();
        
        // 1. Busca a lista de projetos disponíveis para preencher o campo de escolha
        $listaProjetos = $this->metricService->obterProjetosComMetricas();

        // 2. Determina qual ID de projeto exibir (Pega da URL ou assume o primeiro da lista)
        $projetoSelecionadoId = isset($_GET['projeto_id']) ? (int)$_GET['projeto_id'] : 0;
        
        if ($projetoSelecionadoId === 0 && !empty($listaProjetos)) {
            $projetoSelecionadoId = $listaProjetos[0]['id'];
        }

        // 3. Busca e calcula as métricas do projeto selecionado
        $kpis = $this->metricService->obterMetricasPorProjeto($projetoSelecionadoId);

        // 4. Injeta os dados organizados na View
        $dadosView = array_merge($kpis, [
            'projetos' => $listaProjetos,
            'projeto_atual_id' => $projetoSelecionadoId
        ]);

        $this->view('Admin/metrics/metrics', $dadosView, 'admin');
    }
        // Abre o formulário de edição com os dados atuais do projeto selecionado
    public function editar(): void
    {
        AuthMiddleware::handle();

        $projetoId = isset($_GET['projeto_id']) ? (int)$_GET['projeto_id'] : 0;

        if ($projetoId === 0) {
            header('Location: /solucaodigital/public/admin/metricas');
            exit;
        }

        // Pega a lista de projetos e os dados brutos para preencher os inputs
        $listaProjetos = $this->metricService->obterProjetosComMetricas();
        $dadosBrutos = $this->metricService->obterDadosBrutos($projetoId);

        // Busca o nome do projeto atual para mostrar no título da tela
        $db = \App\SolucoesDigitais\Core\Database::getConnection();
        $stmt = $db->prepare("SELECT nome FROM projetos WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $projetoId]);
        $projetoNome = $stmt->fetch()['nome'] ?? 'Projeto';

        $this->view('Admin/metrics/edit', [
            'projeto' => $dadosBrutos,
            'projetos' => $listaProjetos,
            'projeto_nome' => $projetoNome
        ], 'admin');
    }

    // Recebe e processa o formulário de atualização
    public function salvar(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->metricService->salvar($_POST);
            
            // Retorna visualizando as métricas recalculadas daquele mesmo projeto
            header('Location: /solucaodigital/public/admin/metricas?projeto_id=' . (int)$_POST['projeto_id']);
            exit;
        }
    }

}
