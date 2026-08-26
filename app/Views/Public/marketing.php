<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($empresa); ?> - Marketing</title>
    <!-- Você pode linkar seu CSS do XAMPP aqui depois se quiser -->
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; color: #333; }
        .container { max-width: 800px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #111; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .badge { background: #4caf50; color: white; padding: 4px 8px; border-radius: 4px; font-size: 14px; }
        ul { list-style-type: none; padding: 0; }
        li { background: #f1f1f1; margin: 10px 0; padding: 15px; border-left: 5px solid #2196f3; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bem-vindo à <?php echo htmlspecialchars($empresa); ?></h1>
        <p>Status do Sistema: <span class="badge"><?php echo htmlspecialchars($status); ?></span></p>
        
        <h2>Cases de Sucesso (Marketing):</h2>
        <ul>
            <?php foreach ($cases as $case): ?>
                <li>
                    <strong><?php echo htmlspecialchars($case['titulo']); ?></strong>
                    <br>
                    <small>Resultado: <?php echo htmlspecialchars($case['resultado']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>
</html>
