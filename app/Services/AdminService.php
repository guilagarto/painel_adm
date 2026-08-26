<?php

namespace App\SolucoesDigitais\Services;

use App\SolucoesDigitais\Core\Database;

class AdminService
{
    /**
     * Monitora contratos, fluxo de recebimentos, parcelamentos e inadimplência da 80u80.
     */
    public function getDashboardStats(): array
    {
        $db = Database::getConnection();
        $hoje = '2026-08-26'; // Data estável de controle

        // 1. Contadores e somas gerais de fluxo de caixa
        $totalProjetos = $db->query("SELECT COUNT(*) as total FROM projetos")->fetch()['total'];
        
        $querySomas = $db->query("SELECT SUM(valor_contrato) as total_c, SUM(valor_recebido) as total_r FROM projetos");
        $somas = $querySomas->fetch();
        
        $faturamentoContratado = $somas['total_c'] ?? 0;
        $faturamentoRecebido = $somas['total_r'] ?? 0;
        $saldoAFechar = $faturamentoContratado - $faturamentoRecebido;

        // 2. Traz todos os detalhes para a tabela de monitoramento
        $queryLista = $db->query("SELECT id, nome, cliente, valor_contrato, valor_recebido, parcelas, status, prazo_final FROM projetos ORDER BY id DESC");
        $todosProjetos = $queryLista->fetchAll();

        // 3. Varredura inteligente de alertas operacionais e financeiros
        $alertas = [];
        $totalPendentesFinanceiros = 0;

        foreach ($todosProjetos as $p) {
            $saldoDevedor = (float)$p['valor_contrato'] - (float)$p['valor_recebido'];

            // Regra de Alerta de Cobrança: Se tem saldo devedor e o prazo passou do limite, emite alerta de falta de baixa
            if ($saldoDevedor > 0 && !empty($p['prazo_final']) && $p['prazo_final'] < $hoje) {
                $totalPendentesFinanceiros++;
                $alertas[] = [
                    'tipo' => 'financeiro',
                    'mensagem' => "Pendência Financeira: Cliente '{$p['cliente']}' possui saldo devedor de R$ " . number_format($saldoDevedor, 2, ',', '.') . " no projeto '{$p['nome']}'!"
                ];
            }
        }

        if ($totalPendentesFinanceiros === 0) {
            $alertas[] = [
                'tipo' => 'sucesso',
                'mensagem' => 'Inadimplência zerada. Todos os recebimentos estão em dia com os prazos atuais.'
            ];
        }

        return [
            'receita_contratada' => 'R$ ' . number_format($faturamentoContratado, 2, ',', '.'),
            'receita_recebida'   => 'R$ ' . number_format($faturamentoRecebido, 2, ',', '.'),
            'saldo_a_receber'     => 'R$ ' . number_format($saldoAFechar, 2, ',', '.'),
            'total_contratos'    => $totalProjetos,
            'alertas_cobranca'   => $totalPendentesFinanceiros,
            'lista_projetos'     => $todosProjetos,
            'alertas_sistema'    => $alertas
        ];
    }
}
