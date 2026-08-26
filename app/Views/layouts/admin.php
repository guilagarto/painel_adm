<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - 80u80</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; display: flex; height: 100vh; background: #f0f2f5; }
        .sidebar { width: 250px; background: #1a202c; color: white; padding: 20px; box-sizing: border-box; }
        .sidebar h2 { color: #3182ce; font-size: 20px; margin-top: 0; }
        .sidebar a { display: block; color: #cbd5e0; text-decoration: none; padding: 10px; margin: 5px 0; border-radius: 4px; }
        .sidebar a:hover { background: #2d3748; color: white; }
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .admin-header { background: white; padding: 15px; margin: -40px -40px 40px -40px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; }
    </style>
</head>
<body>

    <!-- Barra Lateral do Painel Admin -->
    <aside class="sidebar">
        <h2>Painel 80u80</h2>
     <nav style="display: flex; flex-direction: column; gap: 5px;">
    <a href="/solucaodigital/public/admin">Dashboard</a>
    <a href="/solucaodigital/public/admin/projetos">Projetos</a>
    <a href="/solucaodigital/public/admin/metricas">Métricas</a>
    <a href="/solucaodigital/public/admin/relatorios">Relatórios</a>
    <a href="/solucaodigital/public/admin/blog">Blog (Painel)</a>
    <a href="/solucaodigital/public/admin/leads">Leads (Novos)</a> <!-- Nova aba adicionada -->
    <a href="/solucaodigital/public/admin/usuarios">Usuarios</a>
    
    <hr style="border: 0; border-top: 1px solid #2d3748; margin: 15px 0;">
    <a href="/solucaodigital/public/logout" style="color: #e53e3e; font-weight: bold;">Sair do Sistema</a>
    </nav>

    </aside>

    <!-- Área de Conteúdo do Painel -->
    <main class="main-content">
        <header class="admin-header">
            <div><strong>Ambiente Restrito</strong></div>
            <div>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Administrador'); ?></div>
        </header>
        
        <!-- Injeta a view específica do painel aqui dentro -->
        <?php require_once $viewFile; ?>
    </main>

</body>
</html>
