<h2 style="font-size: 28px; margin-bottom: 10px; color: #111;">Fale Conosco</h2>
<p style="color: #666; margin-bottom: 30px;">Preencha o formulário abaixo. Nossa equipe de Growth entrará em contato em até 2 horas.</p>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
    <div style="background: #f0fff4; border: 1px solid #c6f6d5; color: #22543d; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-weight: bold; font-size: 14px;">
        🚀 Mensagem enviada com sucesso! Verifique sua caixa de entrada para conferir nossa proposta de valor.
    </div>
<?php endif; ?>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 35px; max-width: 600px; box-shadow: 0 4px 6px rgba(0,0,0,0.01); margin-bottom: 50px;">
    <form action="/contato/enviar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">Seu Nome Completo</label>
            <input type="text" name="nome" required placeholder="Ex: Carlos Andrade" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; font-size: 15px;">
        </div>

        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 240px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">E-mail Corporativo</label>
                <input type="email" name="email" required placeholder="Ex: carlos@empresa.com" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; font-size: 15px;">
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">Telefone / WhatsApp</label>
                <input type="text" name="telefone" placeholder="Ex: (11) 99999-9999" style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; font-size: 15px;">
            </div>
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; color: #2d3748;">Fale sobre o seu negócio e objetivos</label>
            <textarea name="mensagem" required rows="5" placeholder="Ex: Preciso estruturar minhas campanhas de tráfego e escalar minhas vendas em 3x..." style="width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; font-family: inherit; font-size: 15px; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 15px; margin-top: 10px;">
            <button type="submit" style="background: #1e3a8a; color: white; border: none; padding: 14px 35px; border-radius: 4px; font-weight: bold; font-size: 15px; cursor: pointer; border-bottom: 3px solid #d4af37; width: 100%; max-width: 220px; text-align: center;">
                Enviar Mensagem &rarr;
            </button>

            <div style="display: flex; align-items: center; width: 100%; max-width: 220px; margin: 5px 0;">
                <hr style="flex: 1; border: 0; border-top: 1px solid #e2e8f0;">
                <span style="font-size: 12px; color: #a0aec0; padding: 0 10px; font-weight: bold;">OU</span>
                <hr style="flex: 1; border: 0; border-top: 1px solid #e2e8f0;">
            </div>

            <a href="https://wa.me." 
               target="_blank" 
               rel="noopener noreferrer"
               style="display: flex; align-items: center; justify-content: center; gap: 10px; background-color: #25d366; color: white; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px; width: 100%; max-width: 220px; box-shadow: 0 3px 8px rgba(37,211,102,0.2); transition: background-color 0.2s;"
               onmouseover="this.style.backgroundColor='#20ba56';"
               onmouseout="this.style.backgroundColor='#25d366';">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff" style="display: block;">
                    <path d="M12.012 2c-5.506 0-9.989 4.478-9.989 9.978 0 1.761.459 3.414 1.261 4.863l-1.284 4.69 4.809-1.258c1.4.764 2.99 1.198 4.685 1.198 5.507 0 9.989-4.478 9.989-9.979 0-5.504-4.482-9.992-9.971-9.992zm5.377 14.167c-.233.656-1.15 1.205-1.585 1.254-.423.048-.962.079-2.585-.561-2.072-.818-3.411-2.923-3.411-2.923s-.308-.415-.847-1.144c-.752-1.02-.924-2.146-.423-2.654.195-.198.502-.303.708-.303.149 0 .285.006.39.014.286.02.435.034.58.337.195.414.671 1.634.729 1.751.058.119.098.257.016.42-.08.163-.163.284-.282.42-.119.134-.251.302-.358.406-.119.117-.245.245-.104.488.141.243.626 1.03 1.34 1.666.721.642 1.328.841 1.573.963.245.122.388.102.488-.014.1-.116.429-.502.551-.676.124-.174.247-.146.411-.085.164.061 1.041.491 1.216.578.174.088.291.132.335.207.043.076.043.435-.19 1.091z"/>
                </svg>
                Falar no WhatsApp
            </a>
        </div>
    </form>
</div>
