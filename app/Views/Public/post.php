<div style="max-width: 800px; margin: 0 auto; background: white; padding: 40px 30px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    
    <a href="/solucaodigital/public/blog" style="color: #1e3a8a; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block; margin-bottom: 20px;">
        &larr; Voltar para a listagem
    </a>

    <small style="color: #d4af37; font-weight: bold; font-size: 13px; display: block; margin-bottom: 10px;">
        Publicado em <?php echo date('d/m/Y', strtotime($artigo['created_at'])); ?>
    </small>
    
    <h1 style="font-size: 32px; color: #111; line-height: 1.2; margin: 0 0 25px 0; font-weight: 800; border-bottom: 2px solid #1e3a8a; padding-bottom: 15px;">
        <?php echo htmlspecialchars($artigo['titulo']); ?>
    </h1>

    <div style="color: #2d3748; font-size: 17px; line-height: 1.8; white-space: pre-wrap;">
        <?php echo nl2br(htmlspecialchars($artigo['conteudo'])); ?>
    </div>
</div>
