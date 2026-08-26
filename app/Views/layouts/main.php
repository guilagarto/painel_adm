<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? '80u80 | Soluções Digitais'); ?></title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2225154349342173"
     crossorigin="anonymous"></script>
    <style>
        :root {
            --azul-metalico: #1e3a8a;
            --dourado: #d4af37;
            --preto: #111111;
            --branco: #ffffff;
            --cinza-claro: #f8fafc;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--cinza-claro); color: var(--preto); line-height: 1.6; }
        
        /* Menu Responsivo */
        header { background: var(--preto); border-bottom: 2px solid var(--dourado); position: sticky; top: 0; z-index: 1000; }
        .nav-container { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: var(--branco); text-decoration: none; letter-spacing: 1px; }
        .logo span { color: var(--dourado); }
        
        nav { display: flex; gap: 20px; }
        nav a { color: var(--branco); text-decoration: none; font-size: 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: var(--dourado); }

        .container { max-width: 1100px; margin: 0 auto; padding: 40px 20px; min-height: 75vh; }
        
        /* Grid de Cards Global (Celular/Desktop) */
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 30px; }
        .card { background: var(--branco); border: 1px solid #e2e8f0; border-radius: 8px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
        
        footer { background: var(--preto); color: #718096; text-align: center; padding: 30px 20px; font-size: 14px; border-top: 1px solid #222; }
        
        /* Ajustes Estritos para Celular */
        @media (max-width: 768px) {
            .nav-container { flex-direction: column; gap: 15px; text-align: center; }
            nav { flex-wrap: wrap; justify-content: center; gap: 12px; }
            nav a { font-size: 14px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="nav-container">
            <a href="/solucaodigital/public/" class="logo">80u80<span>.</span></a>
            <nav>
    <a href="/">Home</a>
    <a href="/solucoes">Soluções</a>
    <a href="/cases">Cases</a>
    <a href="/blog">Blog</a>
    <a href="/sobre">Sobre</a>
    <a href="/contato">Contato</a>
    
    <a href="/admin" style="border: 1px solid var(--dourado); padding: 2px 10px; border-radius: 4px; color: var(--dourado); font-weight: bold;">Painel &rarr;</a>
</nav>

        </div>
    </header>

    <main class="container">
        <?php require_once $viewFile; ?>
    </main>

        <footer style="background: var(--preto); color: #718096; text-align: center; padding: 40px 20px; font-size: 14px; border-top: 1px solid #222;">
        
        <!-- Links de Políticas Exigidos pelo Google AdSense -->
        <div style="margin-bottom: 20px; display: flex; justify-content: center; gap: 25px; flex-wrap: wrap;">
            <a href="/solucaodigital/public/politica-de-privacidade" style="color: #a0aec0; text-decoration: none; font-size: 13px; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='var(--dourado)';" onmouseout="this.style.color='#a0aec0';">Política de Privacidade</a>
            <span style="color: #4a5568;">|</span>
            <a href="/solucaodigital/public/termos-de-uso" style="color: #a0aec0; text-decoration: none; font-size: 13px; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='var(--dourado)';" onmouseout="this.style.color='#a0aec0';">Termos de Uso</a>
        </div>

        <!-- Copyright -->
        <div style="color: #4a5568; font-size: 12px; letter-spacing: 0.5px;">
            &copy; <?php echo date('Y'); ?> <strong style="color: #fff;">80u80 Soluções Digitais</strong>. Todos os direitos reservados.
        </div>
    </footer>


</body>
</html>
