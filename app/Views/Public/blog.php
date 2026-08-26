<h2 style="font-size: 28px; margin-bottom: 10px; color: #111;">Blog 80u80</h2>
<p style="color: #666; margin-bottom: 40px;">Conteúdos estratégicos de Gestão de Negócios, Growth e Marketing Digital.</p>

<div style="display: flex; flex-direction: column; gap: 40px; max-width: 800px;">
    <?php if (empty($artigos)): ?>
        <p style="color: #666;">Nenhum artigo publicado no momento.</p>
    <?php else: ?>
        <?php foreach ($artigos as $artigo): ?>
            <article style="border-bottom: 1px solid #e2e8f0; padding-bottom: 30px;">
                <small style="color: #d4af37; font-weight: bold; font-size: 13px; display: block; margin-bottom: 8px;">
                    📅 <?php echo date('d/m/Y', strtotime($artigo['created_at'])); ?>
                </small>
                <h3 style="font-size: 22px; color: #1e3a8a; margin: 0 0 12px 0; font-weight: 700; line-height: 1.3;">
                    <?php echo htmlspecialchars($artigo['titulo']); ?>
                </h3>
                <p style="color: #4a5568; font-size: 15px; margin-bottom: 20px; line-height: 1.6;">
                    <?php echo htmlspecialchars($artigo['resumo']); ?>
                </p>
                
                <!-- Botão de Acesso ao Artigo Completo passando o ID via GET -->
                <a href="/solucaodigital/public/blog/artigo?id=<?php echo $artigo['id']; ?>" 
                   style="display: inline-block; background: #1e3a8a; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-weight: bold; font-size: 14px; border-bottom: 2px solid #d4af37; transition: background 0.2s;">
                    Ler Artigo Completo &rarr;
                </a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
