<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
    <div>
        <h2 style="margin: 0;">Métricas por Projeto</h2>
        <p style="margin: 5px 0 0 0; color: #666;">Selecione o projeto abaixo para analisar os indicadores e os gráficos de desempenho.</p>
    </div>
    
    <!-- Filtro Seletor Dinâmico por Projeto -->
    <div style="background: white; padding: 10px; border-radius: 6px; border: 1px solid #e2e8f0;">
        <label style="font-weight: bold; font-size: 14px; margin-right: 10px; color: #4a5568;">Filtrar Projeto:</label>
        <select onchange="location = this.value;" style="padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 4px; font-weight: bold; background: #fff; cursor: pointer; color: #2d3748;">
            <?php foreach ($projetos as $proj): ?>
                <option value="/solucaodigital/public/admin/metricas?projeto_id=<?php echo $proj['id']; ?>" <?php echo $proj['id'] == $projeto_atual_id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($proj['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<!-- Grid Principal de 8 KPIs -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 25px;">
    
    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">👥 Visitantes</span>
        <h3 style="font-size: 26px; margin: 10px 0 0 0; color: #2d3748; font-weight: bold;"><?php echo $visitantes; ?></h3>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">🎯 Leads Gerados</span>
        <h3 style="font-size: 26px; margin: 10px 0 0 0; color: #2b6cb0; font-weight: bold;"><?php echo $leads; ?></h3>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">📈 Conversão (Visita > Lead)</span>
        <h3 style="font-size: 26px; margin: 10px 0 0 0; color: #319795; font-weight: bold;"><?php echo $taxa_conversao; ?></h3>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">💰 Clientes Conquistados</span>
        <h3 style="font-size: 26px; margin: 10px 0 0 0; color: #38a169; font-weight: bold;"><?php echo $clientes; ?></h3>
    </div>

    <div style="background: #f0fff4; border: 1px solid #c6f6d5; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #22543d; font-weight: bold; text-transform: uppercase;">💎 Faturamento</span>
        <h3 style="font-size: 24px; margin: 10px 0 0 0; color: #22543d; font-weight: bold;"><?php echo $faturamento; ?></h3>
    </div>

    <div style="background: #fffaf0; border: 1px solid #feebc8; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #c05621; font-weight: bold; text-transform: uppercase;">📢 Investido em Anúncios</span>
        <h3 style="font-size: 24px; margin: 10px 0 0 0; color: #c05621; font-weight: bold;"><?php echo $investimento; ?></h3>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">💸 Custo por Lead (CPL)</span>
        <h3 style="font-size: 24px; margin: 10px 0 0 0; color: #e53e3e; font-weight: bold;"><?php echo $cpl; ?></h3>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <span style="font-size: 12px; color: #718096; font-weight: bold; text-transform: uppercase;">🔄 Conversão (Lead > Cliente)</span>
        <h3 style="font-size: 24px; margin: 10px 0 0 0; color: #805ad5; font-weight: bold;"><?php echo $conversao_leads; ?></h3>
    </div>

</div>

<!-- 📊 ANÁLISE GRÁFICA INTERNA E INSTANTÂNEA DO PROJETO -->
<div style="margin-top: 40px; background: white; border: 1px solid #e2e8f0; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    <h3 style="margin-top: 0; margin-bottom: 25px; color: #2d3748;">Gráficos Analíticos de Performance</h3>
    
    <div style="display: flex; flex-direction: column; gap: 25px;">
        
        <!-- Gráfico 1: ROI Comercial (Proporção Faturamento vs Investimento) -->
        <div>
            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 8px;">
                <span>Proporção de Investimento consumido sobre o Faturamento</span>
                <span style="color: #c05621;"><?php echo $investimento; ?> de <?php echo $faturamento; ?></span>
            </div>
            <!-- Barra de Progresso em HTML/CSS Puro (Indestrutível e Instantânea) -->
            <div style="width: 100%; background: #edf2f7; height: 24px; border-radius: 12px; overflow: hidden; display: flex;">
                <?php
                    // Calcula a largura visual da barra de progresso baseado nos dados
                    $fatFloat = (float)str_replace(['R$', '.', ','], ['', '', '.'], $faturamento);
                    $invFloat = (float)str_replace(['R$', '.', ','], ['', '', '.'], $investimento);
                    $porcentagemBarra = $fatFloat > 0 ? min(($invFloat / $fatFloat) * 100, 100) : 0;
                ?>
                <div style="width: <?php echo $porcentagemBarra; ?>%; background: linear-gradient(90deg, #3182ce, #e53e3e); height: 100%; transition: width 0.5s ease;"></div>
            </div>
            <small style="color: #718096; display: block; margin-top: 5px;">Ideal: Quanto menor a barra vermelha em relação ao faturamento, maior o lucro.</small>
        </div>

        <!-- Gráfico 2: Eficiência do Funil (Taxa de Conversão de Leads em Clientes) -->
        <div>
            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 8px;">
                <span>Eficiência de Conversão do Funil Comercial (Lead para Cliente)</span>
                <span style="color: #805ad5;"><?php echo $conversao_leads; ?></span>
            </div>
            <div style="width: 100%; background: #edf2f7; height: 24px; border-radius: 12px; overflow: hidden;">
                <?php
                    $pctFunil = (float)str_replace('%', '', $conversao_leads);
                ?>
                <div style="width: <?php echo min($pctFunil, 100); ?>%; background: #805ad5; height: 100%; transition: width 0.5s ease;"></div>
            </div>
        </div>

    </div>
</div>

<!-- Botões de Ação Inferiores -->
<div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
    <a href="/solucaodigital/public/admin/metricas/ajustar?projeto_id=<?php echo $projeto_atual_id; ?>" style="background: #3182ce; color: white; text-decoration: none; padding: 12px 20px; border-radius: 6px; font-weight: bold; font-size: 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        ⚙️ Ajustar Métricas deste Projeto
    </a>
</div>
