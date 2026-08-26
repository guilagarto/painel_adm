<div style="max-width: 400px; margin: 60px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-top: 0; color: #111;">Acessar Painel</h2>
    <p style="text-align: center; color: #666; font-size: 14px;">Entre com suas credenciais da 80u80</p>

    <!-- Exibe mensagem de erro se houver -->
    <?php if (!empty($erro)): ?>
        <div style="background: #fff5f5; color: #c53030; padding: 10px; border-left: 4px solid #e53e3e; margin-bottom: 20px; font-size: 14px; border-radius: 4px;">
            <?php echo htmlspecialchars($erro); ?>
        </div>
    <?php endif; ?>

    <form action="/solucaodigital/public/login" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">E-mail</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px;">Senha</label>
            <input type="password" name="senha" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" style="background: #2196f3; color: white; border: none; padding: 12px; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 10px;">
            Entrar no Sistema
        </button>
    </form>
</div>
