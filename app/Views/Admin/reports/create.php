<h2 style="margin-top: 0;">Enviar Novo Relatório</h2>
<p>Vinculando documento diretamente ao projeto: <strong style="color: #2b6cb0;"><?php echo htmlspecialchars($projeto_nome); ?></strong></p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 500px; margin-top: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    
    <!-- Formulário completo com enctype obrigatório para uploads -->
    <form action="/solucaodigital/public/admin/relatorios/salvar" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
        
        <!-- Campo oculto blindado que amarra o arquivo ao projeto correto -->
        <input type="hidden" name="projeto_id" value="<?php echo $projeto_id; ?>">
        
        <!-- Campo: Nome de Exibição -->
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">Nome do Documento</label>
            <input type="text" name="nome_documento" required placeholder="Ex: Auditoria Trimestral de Performance" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <!-- Campo: Upload do Arquivo -->
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">Selecionar Arquivo (Máx: 10MB)</label>
            <input type="file" name="arquivo_upload" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; background: #f7fafc; cursor: pointer;">
            <small style="color: #718096; display: block; margin-top: 5px;">Formatos aceitos: PDF, XLSX, CSV, DOCX</small>
        </div>

        <!-- Botões de Ação -->
        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/relatorios?projeto_id=<?php echo $projeto_id; ?>" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #4caf50; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Fazer Upload</button>
        </div>

    </form>
</div>
