<h2 style="margin-top: 0;">Visão Geral do Sistema</h2>
<p>Bem-vindo ao centro de controle da 80u80 Soluções Digitais. Indicadores operacionais integrados.</p>

<!-- Blocos de Estatísticas Rápidos -->
<div style="display: flex; gap: 20px; margin: 30px 0;">
    <div style="flex: 1; background: #ebf8ff; border: 1px solid #bee3f8; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
        <h4 style="margin: 0; color: #2b6cb0; font-size: 14px; text-transform: uppercase;">Usuários Administrativos</h4>
        <p style="margin: 10px 0 0 0; font-size: 32px; font-weight: bold; color: #2b6cb0;"><?php echo $usuarios_ativos; ?></p>
    </div>
    <div style="flex: 1; background: #f0fff4; border: 1px solid #c6f6d5; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
        <h4 style="margin: 0; color: #22543d; font-size: 14px; text-transform: uppercase;">Total de Projetos</h4>
        <p style="margin: 10px 0 0 0; font-size: 32px; font-weight: bold; color: #22543d;"><?php echo $novos_leads; ?></p>
    </div>
    <div style="flex: 1; background: #faf5ff; border: 1px solid #e9d8fd; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
        <h4 style="margin: 0; color: #553c9a; font-size: 14px; text-transform: uppercase;">Em Desenvolvimento</h4>
        <p style="margin: 10px 0 0 0; font-size: 32px; font-weight: bold; color: #553c9a;"><?php echo $projetos_ativos; ?></p>
    </div>
</div>

<!-- Lista de Logs / Notificações -->
<h3>Alertas do Sistema</h3>
<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
    <?php foreach ($alertas_sistema as $alerta): ?>
        <div style="padding: 12px; margin-bottom: 8px; border-radius: 4px; font-size: 14px; 
            background: <?php echo $alerta['tipo'] === 'critico' ? '#fff5f5' : '#f7fafc'; ?>;
            border-left: 4px solid <?php echo $alerta['tipo'] === 'critico' ? '#e53e3e' : '#4a5568'; ?>;
            color: <?php echo $alerta['tipo'] === 'critico' ? '#9b2c2c' : '#2d3748'; ?>;">
            <strong><?php echo $alerta['tipo'] === 'critico' ? '🚨 CRÍTICO:' : 'ℹ️ SISTEMA:'; ?></strong> 
            <?php echo htmlspecialchars($alerta['mensagem']); ?>
        </div>
    <?php endforeach; ?>
</div>
