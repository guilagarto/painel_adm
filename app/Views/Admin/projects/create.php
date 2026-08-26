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
