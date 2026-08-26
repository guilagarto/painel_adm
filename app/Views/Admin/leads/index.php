<h2 style="margin-top: 0; color: #111;">Central de Leads e Prospecção</h2>
<p style="color: #666;">Gerencie os contatos comerciais e as propostas enviadas através do formulário de contato do site público.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; margin-top: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 15px;">Interessado</th>
                <th style="padding: 15px;">Contatos</th>
                <th style="padding: 15px;">Mensagem / Objetivo</th>
                <th style="padding: 15px; text-align: center;">Status</th>
                <th style="padding: 15px; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($leads)): ?>
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #666;">Nenhum lead comercial capturado pelo formulário ainda.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($leads as $l): 
                    $bgBadge = '#edf2f7'; $colorBadge = '#4a5568';
                    if ($l['status'] === 'Novo') { $bgBadge = '#fed7d7'; $colorBadge = '#e53e3e'; }
                    elseif ($l['status'] === 'Em Atendimento') { $bgBadge = '#feebc8'; $colorBadge = '#dd6b20'; }
                    elseif ($l['status'] === 'Concluído') { $bgBadge = '#c6f6d5'; $colorBadge = '#22543d'; }
                ?>
                    <tr style="border-bottom: 1px solid #e2e8f0; vertical-align: top;">
                        <td style="padding: 15px;">
                            <strong style="color: #1e3a8a; display: block;"><?php echo htmlspecialchars($l['nome']); ?></strong>
                            <small style="color: #718096;"><?php echo date('d/m/Y H:i', strtotime($l['created_at'])); ?></small>
                        </td>
                        <td style="padding: 15px; font-size: 13px;">
                            <span style="display: block;">📧 <?php echo htmlspecialchars($l['email']); ?></span>
                            <span style="display: block; margin-top: 4px;">📱 <?php echo htmlspecialchars($l['telefone']); ?></span>
                        </td>
                        <td style="padding: 15px; color: #2d3748; max-width: 350px; font-size: 13px; line-height: 1.5;">
                            <?php echo nl2br(htmlspecialchars($l['mensagem'])); ?>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: <?php echo $bgBadge; ?>; color: <?php echo $colorBadge; ?>; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; display: inline-block;">
                                <?php echo htmlspecialchars($l['status']); ?>
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center; font-size: 13px;">
                            <?php if ($l['status'] === 'Novo'): ?>
                                <a href="/solucaodigital/public/admin/leads/status?id=<?php echo $l['id']; ?>&status=Em Atendimento" style="color: #3182ce; text-decoration: none; font-weight: bold;">Atender</a>
                            <?php elseif ($l['status'] === 'Em Atendimento'): ?>
                                <a href="/solucaodigital/public/admin/leads/status?id=<?php echo $l['id']; ?>&status=Concluído" style="color: #38a169; text-decoration: none; font-weight: bold;">✔ Concluir</a>
                            <?php else: ?>
                                <span style="color: #a0aec0;">Finalizado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
