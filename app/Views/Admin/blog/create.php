<h2 style="margin-top: 0;">Escrever Novo Artigo</h2>
<p>Crie conteúdos estratégicos para atrair autoridade e visitantes para a 80u80.</p>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 30px; max-width: 700px; margin-top: 20px;">
    <form action="/solucaodigital/public/admin/blog/salvar" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
        
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Título da Publicação</label>
            <input type="text" name="titulo" required placeholder="Ex: 5 erros fatais de conversão em Landing Pages" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Resumo Comercial (Aparece na Home)</label>
            <input type="text" name="resumo" required placeholder="Escreva uma frase curta chamativa que instigue o clique." style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;">Conteúdo Completo do Artigo</label>
            <textarea name="conteudo" required rows="10" placeholder="Escreva o texto completo do seu post aqui..." style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; font-family: inherit; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
            <a href="/solucaodigital/public/admin/blog" style="background: #e2e8f0; color: #4a5568; text-decoration: none; padding: 12px 20px; border-radius: 4px; font-weight: bold; font-size: 14px;">Cancelar</a>
            <button type="submit" style="background: #4caf50; color: white; border: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">Publicar no Site</button>
        </div>
    </form>
</div>
