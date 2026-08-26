<?php
    // Mantém as datas preenchidas nos inputs após o carregamento da página
    $dataInicio = $_GET['data_inicio'] ?? date('Y-01-01');
    $dataFim = $_GET['data_fim'] ?? date('Y-m-d');
?>

<div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 25px;">
    <h2 style="margin-top: 0; margin-bottom: 15px;">Exportação de Relatórios Gerenciais</h2>
    
    <!-- Formulário de Filtro unificado (Projeto + Período de Datas) -->
    <form method="GET" action="/solucaodigital/public/admin/relatorios" style="display: flex; gap: 20px; align-items: flex-end; flex-wrap: wrap;">
        
        <div>
            <label style="display: block; font-weight: bold; font-size: 13px; color: #4a5568; margin-bottom: 5px;">PROJETO</label>
            <select name="projeto_id" style="padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; font-weight: bold; background: #fff; color: #2d3748; min-width: 200px;">
                <?php foreach ($projetos as $proj): ?>
                    <option value="<?php echo $proj['id']; ?>" <?php echo $proj['id'] == $projeto_atual_id ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($proj['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label style="display: block; font-weight: bold; font-size: 13px; color: #4a5568; margin-bottom: 5px;">DATA INICIAL</label>
            <input type="date" name="data_inicio" value="<?php echo $dataInicio; ?>" style="padding: 9px; border: 1px solid #cbd5e0; border-radius: 4px; font-weight: bold; color: #2d3748;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; font-size: 13px; color: #4a5568; margin-bottom: 5px;">DATA FINAL</label>
            <input type="date" name="data_fim" value="<?php echo $dataFim; ?>" style="padding: 9px; border: 1px solid #cbd5e0; border-radius: 4px; font-weight: bold; color: #2d3748;">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #4a5568; color: white; border: none; padding: 11px 20px; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 14px;">
                🔍 Filtrar Período
            </button>
            
            <!-- Link do PDF passando dinamicamente o ID e o intervalo de datas selecionado -->
            <a href="/solucaodigital/public/admin/relatorios/pdf?projeto_id=<?php echo $projeto_atual_id; ?>&data_inicio=<?php echo $dataInicio; ?>&data_fim=<?php echo $dataFim; ?>" style="background: #e53e3e; color: white; text-decoration: none; padding: 11px 20px; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                📄 Baixar PDF do Período
            </a>
        </div>
    </form>
</div>

<div style="background: white; border: 1px solid #e2e8f0; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.01);">
    <h4 style="margin-top: 0; color: #4a5568; text-transform: uppercase; font-size: 12px; border-bottom: 1px solid #edf2f7; padding-bottom: 10px;">
        ℹ️ Instruções do Módulo de Fechamento
    </h4>
    <p style="font-size: 14px; margin-bottom: 0; color: #4a5568;">
        Selecione o intervalo de datas desejado acima e clique em <strong>Filtrar Período</strong> para validar os dados na tela ou clique direto em <strong>Baixar PDF do Período</strong> para emitir a folha de auditoria contendo as somas exatas do intervalo escolhido.
    </p>
</div>
