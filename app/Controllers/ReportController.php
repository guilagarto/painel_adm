<?php

namespace App\SolucoesDigitais\Controllers;

use App\SolucoesDigitais\Core\Controller;
use App\SolucoesDigitais\Middleware\AuthMiddleware;
use App\SolucoesDigitais\Services\ReportService;
use App\SolucoesDigitais\Services\ProjectService;

class ReportController extends Controller
{
    private ReportService $reportService;
    private ProjectService $projectService;

    public function __construct()
    {
        $this->reportService = new ReportService();
        $this->projectService = new ProjectService();
    }

    // Listagem principal de relatórios por projeto
    public function index(): void
    {
        AuthMiddleware::handle();

        $listaProjetos = $this->projectService->listarTodos();

        // Captura o projeto ID da URL ou assume o padrão de formulários GET
        $projetoSelecionadoId = isset($_GET['projeto_id']) ? (int)$_GET['projeto_id'] : 0;
        if ($projetoSelecionadoId === 0 && !empty($listaProjetos)) {
            $projetoSelecionadoId = (int)$listaProjetos[0]['id'];
        }

        $this->view('Admin/reports/reports', [
            'projetos' => $listaProjetos,
            'projeto_atual_id' => $projetoSelecionadoId
        ], 'admin');
    }

    public function exportarPdf(): void
    {
        AuthMiddleware::handle();

        $projetoId = isset($_GET['projeto_id']) ? (int)$_GET['projeto_id'] : 0;
        // Captura o intervalo de datas vindo da URL
        $dataInicio = $_GET['data_inicio'] ?? '';
        $dataFim = $_GET['data_fim'] ?? '';

        if ($projetoId === 0) {
            header('Location: /solucaodigital/public/admin/relatorios');
            exit;
        }

        // 1. Puxa as métricas passando os filtros cronológicos de data
        $metricasService = new \App\SolucoesDigitais\Services\MetricsService();
        $kpis = $metricasService->obterMetricasPorProjeto($projetoId, $dataInicio, $dataFim);

        $db = \App\SolucoesDigitais\Core\Database::getConnection();
        $stmt = $db->prepare("SELECT nome FROM projetos WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $projetoId]);
        $projeto = $stmt->fetch();
        $projetoNome = $projeto ? $projeto['nome'] : 'Projeto';

        // Modifica ligeiramente o título do PDF para incluir a informação do período selecionado
        $periodoTexto = "Período: " . date('d/m/Y', strtotime($dataInicio)) . " até " . date('d/m/Y', strtotime($dataFim));
        $projetoNomeComData = $projetoNome . " (" . $periodoTexto . ")";

        $this->reportService->gerarPdfMetricas($projetoNomeComData, $kpis);
    }

    // Métodos mantidos caso você ainda utilize a função de upload avulso
    public function criar(): void
    {
        AuthMiddleware::handle();
        $projetoId = isset($_GET['projeto_id']) ? (int)$_GET['projeto_id'] : 0;

        $db = \App\SolucoesDigitais\Core\Database::getConnection();
        $stmt = $db->prepare("SELECT nome FROM projetos WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $projetoId]);
        $projetoNome = $stmt->fetch()['nome'] ?? 'Projeto';

        $this->view('Admin/reports/create', [
            'projeto_id' => $projetoId,
            'projeto_nome' => $projetoNome
        ], 'admin');
    }

    public function salvar(): void
    {
        AuthMiddleware::handle();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo_upload'])) {
            $arquivo = $_FILES['arquivo_upload'];
            $projetoId = (int)$_POST['projeto_id'];

            if ($arquivo['error'] === UPLOAD_ERR_OK) {
                $nomeOriginal = $arquivo['name'];
                $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
                $tamanhoMB = number_format($arquivo['size'] / (1024 * 1024), 1, ',', '.') . ' MB';
                $novoNomeArquivo = md5(uniqid(rand(), true)) . '.' . $extensao;
                
                if (move_uploaded_file($arquivo['tmp_name'], \ROOT_PATH . '/public/uploads/' . $novoNomeArquivo)) {
                    $this->reportService->salvar([
                        'projeto_id'     => $projetoId,
                        'nome_documento' => $_POST['nome_documento'],
                        'formato'        => $extensao,
                        'tamanho'        => $tamanhoMB,
                        'arquivo_path'   => $novoNomeArquivo
                    ]);
                }
            }
            header('Location: /solucaodigital/public/admin/relatorios?projeto_id=' . $projetoId);
            exit;
        }
    }

    public function excluir(): void
    {
        AuthMiddleware::handle();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $relatorio = $this->reportService->buscarPorId($id);

        if ($relatorio) {
            $arquivoFisico = \ROOT_PATH . '/public/uploads/' . $relatorio['arquivo_path'];
            if (file_exists($arquivoFisico)) { unlink($arquivoFisico); }
            $this->reportService->excluir($id);
            header('Location: /solucaodigital/public/admin/relatorios?projeto_id=' . $relatorio['projeto_id']);
            exit;
        }
        header('Location: /solucaodigital/public/admin/relatorios');
        exit;
    }
}
