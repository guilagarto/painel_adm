<h2 style="margin-top: 0;">Ajustar Indicadores</h2>
<p>Atualize os dados de tráfego, captação e faturamento do projeto: <strong><?php echo htmlspecialchars($projeto_nome); ?></strong></p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 600px; margin-top: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    <form action="/solucaodigital/public/admin/metricas/salvar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <!-- ID do projeto oculto para saber onde salvar -->
        <input type="hidden" name="projeto_id" value="<?php echo $projeto['projeto_id']; ?>">

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">👥 Visitantes Únicos</label>
                <input type="number" name="visitantes" required value="<?php echo $projeto['visitantes']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
            
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">🎯 Leads Gerados</label>
                <input type="number" name="leads" required value="<?php echo $projeto['leads']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">💰 Clientes Fechados</label>
                <input type="number" name="clientes" required value="<?php echo $projeto['clientes']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;"></div>
        </div>

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 10px 0;">

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">💎 Faturamento Bruto (R$)</label>
                <input type="text" name="faturamento" required value="<?php echo number_format($projeto['faturamento'], 2, ',', '.'); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
            
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">📢 Investimento em Anúncios (R$)</label>
                <input type="text" name="investido_anuncios" required value="<?php echo number_format($projeto['investido_anuncios'], 2, ',', '.'); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 15px;">
            <a href="/solucaodigital/public/admin/metricas?projeto_id=<?php echo $projeto['projeto_id']; ?>" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #3182ce; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Salvar Métricas</button>
        </div>
    </form>
</div>
