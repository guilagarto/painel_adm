<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class MetricsService
{
    /**
     * Retorna la lista de TODOS os projetos ativos para preencher o filtro seletor.
     */
    public function obterProjetosComMetricas(): array
    {
        $db = Database::getConnection();
        $query = $db->query("SELECT id, nome FROM projetos ORDER BY nome ASC");
        return $query->fetchAll();
    }

    /**
     * Busca e calcula todas as métricas acumuladas de um projeto dentro de um período específico.
     */
    public function obterMetricasPorProjeto(int $projetoId, string $dataInicio = '', string $dataFim = ''): array
    {
        $db = Database::getConnection();

        // Se as datas não forem passadas, define o início do ano atual até o dia de hoje por padrão
        if (empty($dataInicio)) { $dataInicio = date('Y-01-01'); }
        if (empty($dataFim)) { $dataFim = date('Y-m-d'); }
        
        $sql = "SELECT 
                    SUM(visitantes) as visitantes, 
                    SUM(leads) as leads, 
                    SUM(clientes) as clientes, 
                    SUM(faturamento) as faturamento, 
                    SUM(investido_anuncios) as investido_anuncios 
                FROM projeto_metricas 
                WHERE projeto_id = :projeto_id 
                  AND data_registro BETWEEN :data_inicio AND :data_fim";
                  
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'projeto_id'  => $projetoId,
            'data_inicio' => $dataInicio,
            'data_fim'    => $dataFim
        ]);
        
        $dados = $stmt->fetch();

        // Se não houver nenhum lançamento no período selecionado, retorna zerado padrão
        if (!$dados || is_null($dados['visitantes'])) {
            return [
                'visitantes'      => '0',
                'leads'           => '0',
                'taxa_conversao'  => '0%',
                'clientes'        => '0',
                'faturamento'     => 'R$ 0,00',
                'investimento'    => 'R$ 0,00',
                'cpl'             => 'R$ 0,00',
                'conversao_leads' => '0%'
            ];
        }

        // --- CÁLCULOS MATEMÁTICOS DE BI ---
        $taxaConversao = $dados['visitantes'] > 0 ? ($dados['leads'] / $dados['visitantes']) * 100 : 0;
        $cpl = $dados['leads'] > 0 ? $dados['investido_anuncios'] / $dados['leads'] : 0;
        $conversaoLeadsClientes = $dados['leads'] > 0 ? ($dados['clientes'] / $dados['leads']) * 100 : 0;

        return [
            'visitantes'       => number_format($dados['visitantes'], 0, '', '.'),
            'leads'            => number_format($dados['leads'], 0, '', '.'),
            'taxa_conversao'   => number_format($taxaConversao, 2, ',', '') . '%',
            'clientes'         => number_format($dados['clientes'], 0, '', '.'),
            'faturamento'      => 'R$ ' . number_format($dados['faturamento'], 2, ',', '.'),
            'investimento'     => 'R$ ' . number_format($dados['investido_anuncios'], 2, ',', '.'),
            'cpl'              => 'R$ ' . number_format($cpl, 2, ',', '.'),
            'conversao_leads'  => number_format($conversaoLeadsClientes, 2, ',', '') . '%'
        ];
    }

    /**
     * Busca os dados brutos (sem formatação) de métricas de um projeto para o formulário de ajuste.
     */
    public function obterDadosBrutos(int $projetoId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT projeto_id, visitantes, leads, clientes, faturamento, investido_anuncios 
                              FROM projeto_metricas WHERE projeto_id = :projeto_id ORDER BY id DESC LIMIT 1");
        $stmt->execute(['projeto_id' => $projetoId]);
        $dados = $stmt->fetch();

        if (!$dados) {
            return [
                'projeto_id' => $projetoId, 'visitantes' => 0, 'leads' => 0, 
                'clientes' => 0, 'faturamento' => 0, 'investido_anuncios' => 0
            ];
        }

        return $dados;
    }

    /**
     * Salva ou atualiza as métricas de um projeto específico.
     */
    public function salvar(array $dados): bool
    {
        $db = Database::getConnection();
        
        $faturamento = (float)str_replace(['R$', '.', ','], ['', '', '.'], $dados['faturamento']);
        $investimento = (float)str_replace(['R$', '.', ','], ['', '', '.'], $dados['investido_anuncios']);

        $sql = "INSERT INTO projeto_metricas (projeto_id, data_registro, visitantes, leads, clientes, faturamento, investido_anuncios) 
                VALUES (:projeto_id, :data_registro, :visitantes, :leads, :clientes, :faturamento, :investimento)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'projeto_id'    => (int)$dados['projeto_id'],
            'data_registro' => !empty($dados['data_registro']) ? $dados['data_registro'] : date('Y-m-d'),
            'visitantes'    => (int)$dados['visitantes'],
            'leads'         => (int)$dados['leads'],
            'clientes'      => (int)$dados['clientes'],
            'faturamento'   => $faturamento,
            'investimento'  => $investimento
        ]);
    }
}
