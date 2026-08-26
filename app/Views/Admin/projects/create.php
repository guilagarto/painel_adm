<h2 style="margin-top: 0;">Cadastrar Novo Projeto</h2>
<p>Preencha os campos abaixo para abrir uma nova ordem de serviço na agência.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 600px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/projetos/salvar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Nome do Projeto</label>
            <input type="text" name="nome" required placeholder="Ex: App Delivery" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Cliente</label>
            <input type="text" name="cliente" required placeholder="Ex: Supermercado XYZ" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Status Inicial</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
                    <option value="Planejamento">Planejamento</option>
                    <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                    <option value="Homologação">Homologação</option>
                    <option value="Concluído">Concluído</option>
                </select>
            </div>
            
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Data de Entrega</label>
                <input type="date" name="data_entrega" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/projetos" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #4caf50; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Salvar Projeto</button>
        </div>
    </form>
</div>
<h2 style="margin-top: 0;">Cadastrar Novo Projeto</h2>
<p>Preencha os campos abaixo para abrir uma nova ordem de serviço e configurar o faturamento na agência.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 650px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/projetos/salvar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Nome do Projeto</label>
                <input type="text" name="nome" required placeholder="Ex: App Delivery" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Cliente</label>
                <input type="text" name="cliente" required placeholder="Ex: Supermercado XYZ" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <!-- 💰 BLOCO FINANCEIRO ADICIONADO -->
        <div style="display: flex; gap: 20px; background: #f7fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #2d3748;">Valor do Contrato (R$)</label>
                <input type="text" name="valor_contrato" required placeholder="Ex: 5000.00" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #2d3748;">Valor Recebido / Entrada (R$)</label>
                <input type="text" name="valor_recebido" required placeholder="Ex: 2500.00" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
            </div>
            <div style="flex: 1; max-width: 120px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #2d3748;">Nº Parcelas</label>
                <input type="number" name="parcelas" required min="1" value="1" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
            </div>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Status Inicial</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
                    <option value="Planejamento">Planejamento</option>
                    <option value="Em Desenvolvimento">Em Desenvolvimento</option>
                    <option value="Homologação">Homologação</option>
                    <option value="Concluído">Concluído</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Prazo Final de Entrega</label>
                <input type="date" name="prazo_final" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/projetos" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #4caf50; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Salvar Contrato</button>
        </div>
    </form>
</div>

