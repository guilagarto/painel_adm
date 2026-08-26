<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0;">Gerenciamento do Blog</h2>
    <a href="/solucaodigital/public/admin/blog/novo" style="background: #4caf50; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; font-size: 14px;">
        + Escrever Artigo
    </a>
</div>

<p>Gerencie as publicações de conteúdo que alimentam a página inicial e a página de Blog do site público.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; margin-top: 20px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr style="background: #f7fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 15px;">Título do Post</th>
                <th style="padding: 15px;">Resumo Curto</th>
                <th style="padding: 15px;">Data de Publicação</th>
                <th style="padding: 15px; text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($artigos)): ?>
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: #666;">Nenhum artigo publicado no blog ainda.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($artigos as $post): ?>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 15px; font-weight: bold; color: #1e3a8a;"><?php echo htmlspecialchars($post['titulo']); ?></td>
                        <td style="padding: 15px; color: #4a5568; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($post['resumo']); ?></td>
                        <td style="padding: 15px; color: #718096;"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="/solucaodigital/public/admin/blog/excluir?id=<?php echo $post['id']; ?>" onclick="return confirm('Excluir este artigo permanentemente do blog?');" style="color: #e53e3e; text-decoration: none; font-weight: bold;">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
