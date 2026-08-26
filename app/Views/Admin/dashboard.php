<h2 style="margin-top: 0; color: #111;">Fluxo de Caixa e Controle Operacional | 80u80</h2>
<p style="color: #666;">Acompanhe em tempo real o faturamento contratado, valores recebidos e cobranças automatizadas por projeto.</p>

<!-- Grid 1: Indicadores do Livro de Caixa e Prazos -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 25px 0;">
    
    <div style="background: white; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; border-left: 4px solid #3182ce;">
        <h4 style="margin: 0; color: #4a5568; font-size: 11px; text-transform: uppercase;">📄 Total Contratado</h4>
        <p style="margin: 8px 0 0 0; font-size: 22px; font-weight: bold; color: #2b6cb0;"><?php echo $receita_contratada; ?></p>
    </div>

    <div style="background: #f0fff4; border: 1px solid #c6f6d5; padding: 15px; border-radius: 8px; border-left: 4px solid #38a169;">
        <h4 style="margin: 0; color: #22543d; font-size: 11px; text-transform: uppercase;">💰 Recebido (Dinheiro no Caixa)</h4>
        <p style="margin: 8px 0 0 0; font-size: 22px; font-weight: bold; color: #22543d;"><?php echo $receita_recebida; ?></p>
    </div>

    <div style="background: #fffaf0; border: 1px solid #feebc8; padding: 15px; border-radius: 8px; border-left: 4px solid #dd6b20;">
        <h4 style="margin: 0; color: #c05621; font-size: 11px; text-transform: uppercase;">⏳ Saldo a Receber</h4>
        <p style="margin: 8px 0 0 0; font-size: 22px; font-weight: bold; color: #c05621;"><?php echo $saldo_a_receber; ?></p>
    </div>

    <div style="background: <?php echo $alertas_cobranca > 0 ? '#fff5f5' : '#f7fafc'; ?>; border: 1px solid <?php echo $alertas_cobranca > 0 ? '#fed7d7' : '#e2e8f0'; ?>; padding: 15px; border-radius: 8px; border-left: 4px solid <?php echo $alertas_cobranca > 0 ? '#e53e3e' : '#718096'; ?>;">
        <h4 style="margin: 0; color: <?php echo $alertas_cobranca > 0 ? '#e53e3e' : '#4a5568'; ?>; font-size: 11px; text-transform: uppercase;">🚨 Cobranças Pendentes</h4>
        <p style="margin: 8px 0 0 0; font-size: 22px; font-weight: bold; color: <?php echo $alertas_cobranca > 0 ? '#e53e3e' : '#2d3748'; ?>;"><?php echo $alertas_cobranca; ?></p>
    </div>

</div>

<!-- Estrutura Principal -->
<div style="display: flex; gap: 25px; flex-wrap: wrap; margin-top: 30px;">
    
    <!-- Tabela Financeira de Auditoria Interna -->
    <div style="flex: 2; min-width: 400px;">
        <h3 style="margin-bottom: 15px; color: #2d3748; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px;">Acompanhamento Financeiro por Contrato</h3>
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                <thead>
                    <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px;">Projeto / Cliente</th>
                        <th style="padding: 12px;">Valor Total</th>
                        <th style="padding: 12px;">Recebido</th>
                        <th style="padding: 12px;">Parcelas</th>
                        <th style="padding: 12px;">Saldo Restante</th>
                        <th style="padding: 12px; text-align: center;">Status Financeiro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_projetos as $p): 
                        $contratoFloat = (float)$p['valor_contrato'];
                        $recebidoFloat = (float)$p['valor_recebido'];
                        $restante = $contratoFloat - $recebidoFloat;
                        $temDebitoVencido = ($restante > 0 && !empty($p['prazo_final']) && $p['prazo_final'] < '2026-08-26');
                    ?>
                        <tr style="border-bottom: 1px solid #e2e8f0; background: <?php echo $temDebitoVencido ? '#fff5f5' : 'transparent'; ?>;">
                            <td style="padding: 12px;">
                                <strong style="color: #1e3a8a; display: block;"><?php echo htmlspecialchars($p['nome']); ?></strong>
                                <span style="font-size: 11px; color: #718096;"><?php echo htmlspecialchars($p['cliente']); ?></span>
                            </td>
                            <td style="padding: 12px; color: #2d3748;">R$ <?php echo number_format($contratoFloat, 2, ',', '.'); ?></td>
                            <td style="padding: 12px; color: #38a169; font-weight: bold;">R$ <?php echo number_format($recebidoFloat, 2, ',', '.'); ?></td>
                            <td style="padding: 12px; color: #4a5568; text-align: center;"><?php echo $p['parcelas']; ?>x</td>
                            <td style="padding: 12px; color: <?php echo $restante > 0 ? '#dd6b20' : '#718096'; ?>; font-weight: bold;">
                                R$ <?php echo number_format($restante, 2, ',', '.'); ?>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <?php if ($restante == 0): ?>
                                    <span style="background: #c6f6d5; color: #22543d; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: bold;">✅ Quitado (Baixa)</span>
                                <?php elseif ($temDebitoVencido): ?>
                                    <span style="background: #fed7d7; color: #e53e3e; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: bold;">🚨 Pendente / Atrasado</span>
                                <?php else: ?>
                                    <span style="background: #feebc8; color: #c05621; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: bold;">⏳ Em Aberto</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Central de Monitoramento e Alertas Financeiros -->
    <div style="flex: 1; min-width: 250px;">
        <h3 style="margin-bottom: 15px; color: #2d3748; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px;">Alertas do Caixa</h3>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <?php foreach ($alertas_sistema as $alerta): ?>
                <div style="padding: 12px; border-radius: 6px; font-size: 12px; line-height: 1.4;
                    background: <?php echo $alerta['tipo'] === 'financeiro' ? '#fff5f5' : '#f0fff4'; ?>;
                    border-left: 4px solid <?php echo $alerta['tipo'] === 'financeiro' ? '#e53e3e' : '#38a169'; ?>;
                    color: <?php echo $alerta['tipo'] === 'financeiro' ? '#9b2c2c' : '#22543d'; ?>;">
                    <strong><?php echo $alerta['tipo'] === 'financeiro' ? '🚨 COBRANÇA CRÍTICA:' : '✅ SISTEMA:'; ?></strong> 
                    <?php echo htmlspecialchars($alerta['mensagem']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
