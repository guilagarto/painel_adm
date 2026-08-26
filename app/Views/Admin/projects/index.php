<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0;">Gestão de Projetos</h2>
    <a href="/solucaodigital/public/admin/projetos/novo" style="background: #2196f3; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; font-size: 14px;">
    + Novo Projeto
</a>
</div>

<p>Gerencie o cronograma, clientes e andamento das entregas ativas da agência.</p>

<!-- Tabela de Projetos Estilizada -->
<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; margin-top: 20px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 15px;">Projeto</th>
                <th style="padding: 15px;">Cliente</th>
                <th style="padding: 15px;">Status</th>
                <th style="padding: 15px;">Prazo de Entrega</th>
                <th style="padding: 15px; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($projetos)): ?>
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #666;">Nenhum projeto cadastrado no banco de dados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($projetos as $projeto): 
                    // Define cores dinâmicas para as badges de status
                    $bgStatus = '#edf2f7'; $colorStatus = '#4a5568';
                    if ($projeto['status'] === 'Em Desenvolvimento') { $bgStatus = '#eebffa'; $colorStatus = '#553c9a'; }
                    elseif ($projeto['status'] === 'Homologação') { $bgStatus = '#feebc8'; $colorStatus = '#c05621'; }
                    elseif ($projeto['status'] === 'Concluído') { $bgStatus = '#c6f6d5'; $colorStatus = '#22543d'; }
                ?>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 15px; font-weight: bold; color: #2d3748;"><?php echo htmlspecialchars($projeto['nome']); ?></td>
                        <td style="padding: 15px; color: #4a5568;"><?php echo htmlspecialchars($projeto['cliente']); ?></td>
                        <td style="padding: 15px;">
                            <span style="background: <?php echo $bgStatus; ?>; color: <?php echo $colorStatus; ?>; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;">
                                <?php echo htmlspecialchars($projeto['status']); ?>
                            </span>
                        </td>
                        <td style="padding: 15px; color: #4a5568;">
                            <?php echo $projeto['data_entrega'] ? date('d/m/Y', strtotime($projeto['data_entrega'])) : 'Não definida'; ?>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="/solucaodigital/public/admin/projetos/editar?id=<?php echo $projeto['id']; ?>" 
                            style="color: #2196f3; text-decoration: none; margin-right: 10px; font-weight: bold;">Editar</a>
                            <!-- Mude a linha do Excluir para ficar exatamente assim: -->
                            <a href="/solucaodigital/public/admin/projetos/excluir?id=<?php echo $projeto['id']; ?>" 
                            onclick="return confirm('Tem certeza que deseja excluir o projeto: <?php echo htmlspecialchars($projeto['nome']); ?>?');" 
                            style="color: #e53e3e; text-decoration: none; font-weight: bold;">Excluir</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
