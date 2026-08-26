<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0;">Gestão de Usuários</h2>
    <a href="/solucaodigital/public/admin/usuarios/novo" style="background: #2196f3; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; font-size: 14px;">
        + Novo Usuário
    </a>
</div>

<p>Gerencie as contas de administradores que possuem credenciais para acessar o painel de controle da agência.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; margin-top: 20px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 15px;">Nome do Usuário</th>
                <th style="padding: 15px;">E-mail Cadastrado</th>
                <th style="padding: 15px;">Data de Criação</th>
                <th style="padding: 15px; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $user): ?>
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 15px; font-weight: bold; color: #2d3748;"><?php echo htmlspecialchars($user['nome']); ?></td>
                    <td style="padding: 15px; color: #4a5568;"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td style="padding: 15px; color: #718096;"><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                    <td style="padding: 15px; text-align: center;">
                        <a href="/solucaodigital/public/admin/usuarios/excluir?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja revogar o acesso deste usuário?');" style="color: #e53e3e; text-decoration: none; font-weight: bold;">Remover Acesso</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
