<h2 style="margin-top: 0;">Editar Projeto</h2>
<p>Altere as informações desejadas do projeto abaixo.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 600px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/projetos/atualizar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <!-- Campo oculto contendo o ID do projeto que está sendo editado -->
        <input type="hidden" name="id" value="<?php echo $projeto['id']; ?>">
        
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Nome do Projeto</label>
            <input type="text" name="nome" required value="<?php echo htmlspecialchars($projeto['nome']); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Cliente</label>
            <input type="text" name="cliente" required value="<?php echo htmlspecialchars($projeto['cliente']); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Status</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
                    <option value="Planejamento" <?php echo $projeto['status'] === 'Planejamento' ? 'selected' : ''; ?>>Planejamento</option>
                    <option value="Em Desenvolvimento" <?php echo $projeto['status'] === 'Em Desenvolvimento' ? 'selected' : ''; ?>>Em Desenvolvimento</option>
                    <option value="Homologação" <?php echo $projeto['status'] === 'Homologação' ? 'selected' : ''; ?>>Homologação</option>
                    <option value="Concluído" <?php echo $projeto['status'] === 'Concluído' ? 'selected' : ''; ?>>Concluído</option>
                </select>
            </div>
            
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Data de Entrega</label>
                <input type="date" name="data_entrega" value="<?php echo $projeto['data_entrega']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/projetos" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #2196f3; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Salvar Alterações</button>
        </div>
    </form>
</div>
<h2 style="margin-top: 0;">Editar Contrato e Projeto</h2>
<p>Atualize o andamento operacional ou realize baixas de pagamento do projeto.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 650px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/projetos/atualizar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <input type="hidden" name="id" value="<?php echo $projeto['id']; ?>">
        
        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Nome do Projeto</label>
                <input type="text" name="nome" required value="<?php echo htmlspecialchars($projeto['nome']); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Cliente</label>
                <input type="text" name="cliente" required value="<?php echo htmlspecialchars($projeto['cliente']); ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <!-- 💰 MONITORAMENTO FINANCEIRO E BAIXAS DE PARCELAS -->
        <div style="display: flex; gap: 20px; background: #fffaf0; padding: 15px; border-radius: 6px; border: 1px solid #feebc8;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #c05621;">Valor Total Cobrado (R$)</label>
                <input type="text" name="valor_contrato" required value="<?php echo $projeto['valor_contrato']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #c05621;">Valor Recebido Acumulado (R$)</label>
                <input type="text" name="valor_recebido" required value="<?php echo $projeto['valor_recebido']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
                <span style="font-size: 11px; color: #718096; display: block; margin-top: 4px;">Para quitar, iguale este valor ao total.</span>
            </div>
            <div style="flex: 1; max-width: 120px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #c05621;">Nº Parcelas</label>
                <input type="number" name="parcelas" required min="1" value="<?php echo $projeto['parcelas']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: white;">
            </div>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Status</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
                    <option value="Planejamento" <?php echo $projeto['status'] === 'Planejamento' ? 'selected' : ''; ?>>Planejamento</option>
                    <option value="Em Desenvolvimento" <?php echo $projeto['status'] === 'Em Desenvolvimento' ? 'selected' : ''; ?>>Em Desenvolvimento</option>
                    <option value="Homologação" <?php echo $projeto['status'] === 'Homologação' ? 'selected' : ''; ?>>Homologação</option>
                    <option value="Concluído" <?php echo $projeto['status'] === 'Concluído' ? 'selected' : ''; ?>>Concluído</option>
                </select>
            </div>
            
            <div style="flex: 1;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Prazo Final de Entrega</label>
                <input type="date" name="prazo_final" value="<?php echo $projeto['prazo_final']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/projetos" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #2196f3; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Salvar Alterações</button>
        </div>
    </form>
</div>
