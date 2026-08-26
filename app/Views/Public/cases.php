<h2 style="font-size: 28px; margin-bottom: 10px; color: #111;">Cases de Sucesso</h2>
<p style="color: #666; margin-bottom: 40px;">Resultados e eficiência de performance gerados para nossos parceiros comerciais.</p>

<div class="card-grid">
    <?php if (empty($cases)): ?>
        <p style="color: #666;">Nenhum case publicado até o momento.</p>
    <?php else: ?>
        <?php foreach ($cases as $case): 
            $faturamento = (float)$case['faturamento'];
            $investimento = (float)$case['investimento'];
            $leads = (int)$case['leads'];
            $clientes = (int)$case['clientes'];

            // 1. Cálculo do ROI Percentual Puro
            $roiPercentual = $investimento > 0 ? ($faturamento / $investimento) * 100 : 0;
            
            // 2. Cálculo da Taxa de Conversão de Leads em Clientes
            $conversaoVendas = $leads > 0 ? ($clientes / $leads) * 100 : 0;

            // Define a largura máxima visual das barras do gráfico (limitado a 100% no CSS)
            $barraRoiVisivel = min(($roiPercentual / 500) * 100, 100); // 500% preenche a barra toda como referência premium
            $barraVendasVisivel = min($conversaoVendas * 10, 100); // Escala visual para destacar taxas menores de venda
        ?>
            <div class="card" style="border-top: 4px solid var(--azul-metalico); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 25px; color: #111; font-weight: 700; letter-spacing: 0.5px;">
                        🚀 <?php echo htmlspecialchars($case['nome']); ?>
                    </h4>
                    
                    <!-- Indicadores Visuais Percentuais -->
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        
                        <!-- Barra 1: Retorno de Investimento (ROI) -->
                        <div>
                            <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: bold; margin-bottom: 6px;">
                                <span style="color: #4a5568;">Retorno sobre o Investimento (ROI)</span>
                                <span style="color: #38a169; font-size: 14px;">+<?php echo number_format($roiPercentual, 0, ',', '.'); ?>%</span>
                            </div>
                            <div style="width: 100%; background: #edf2f7; height: 12px; border-radius: 6px; overflow: hidden;">
                                <div style="width: <?php echo $barraRoiVisivel; ?>%; background: linear-gradient(90deg, #38a169, #2f855a); height: 100%; border-radius: 6px;"></div>
                            </div>
                        </div>

                        <!-- Barra 2: Eficiência do Funil Comercial -->
                        <div>
                            <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: bold; margin-bottom: 6px;">
                                <span style="color: #4a5568;">Eficiência Comercial (Conversion Rate)</span>
                                <span style="color: var(--azul-metalico); font-size: 14px;"><?php echo number_format($conversaoVendas, 2, ',', ''); ?>%</span>
                            </div>
                            <div style="width: 100%; background: #edf2f7; height: 12px; border-radius: 6px; overflow: hidden;">
                                <div style="width: <?php echo $barraVendasVisivel; ?>%; background: var(--azul-metalico); height: 100%; border-radius: 6px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div style="margin-top: 25px; font-size: 12px; color: #718096; text-transform: uppercase; font-weight: bold; tracking: 0.5px;">
                    🛡️ Dados de auditoria protegidos
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
