<section style="text-align: center; padding: 40px 0; border-bottom: 1px solid #e2e8f0;">
    <h1 style="font-size: 38px; color: #111; font-weight: 800;">Estratégia Digital de Alta Performance</h1>
    <p style="font-size: 18px; color: #4a5568; max-width: 600px; margin: 15px auto 30px auto;">Aceleramos a aquisição de clientes e o faturamento do seu negócio usando inteligência de dados.</p>
    <a href="/solucaodigital/public/contato" style="background: #1e3a8a; color: white; text-decoration: none; padding: 12px 30px; border-radius: 4px; font-weight: bold; border-bottom: 3px solid #d4af37;">Fale com um Especialista</a>
</section>

<h3 style="margin-top: 50px; font-size: 22px; color: #111; letter-spacing: 0.5px;">Artigos Recentes do Blog</h3>
<div class="card-grid">
    <?php foreach ($artigos as $artigo): ?>
        <div class="card">
            <small style="color: #d4af37; font-weight: bold; font-size: 12px;"><?php echo date('d/m/Y', strtotime($artigo['created_at'])); ?></small>
            <h4 style="margin: 5px 0 10px 0; font-size: 18px; color: #1e3a8a;"><?php echo htmlspecialchars($artigo['titulo']); ?></h4>
            <p style="color: #4a5568; font-size: 14px; margin-bottom: 15px;"><?php echo htmlspecialchars($artigo['resumo']); ?></p>
            <a href="/solucaodigital/public/blog" style="color: #111; font-weight: bold; text-decoration: none; font-size: 14px; border-bottom: 2px solid #d4af37;">Ler Artigo completo &rarr;</a>
        </div>
    <?php endforeach; ?>
</div>
