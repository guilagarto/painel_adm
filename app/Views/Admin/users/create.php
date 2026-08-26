<h2 style="margin-top: 0;">Cadastrar Administrador</h2>
<p>Preencha os dados abaixo para gerar um novo login seguro de acesso ao painel.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 500px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/usuarios/salvar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Nome Completo</label>
            <input type="text" name="nome" required placeholder="Ex: João Silva" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">E-mail de Acesso (Único)</label>
            <input type="email" name="email" required placeholder="Ex: joao@80u80.com" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Senha Provisória</label>
            <input type="password" name="senha" required placeholder="Mínimo 6 caracteres" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/usuarios" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #2196f3; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Cadastrar Usuário</button>
        </div>
    </form>
</div>
