<?php
// Força exibição máxima ignorando qualquer trava da Hostinger
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/Core/Database.php';

use App\SolucoesDigitais\Core\Database;

echo "<h2>🔍 Diagnóstico de Autenticação Direta</h2>";

try {
    $db = Database::getConnection();
    echo "<p style='color:green;'>✅ Conexão com o banco de dados da Hostinger realizada com sucesso!</p>";
    
    $emailTest = 'admin@8ou80.com';
    $senhaTest = 'admin123';
    
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $emailTest]);
    $usuario = $stmt->fetch();
    
    if (!$usuario) {
        die("<p style='color:red;'>❌ Erro: O e-mail <strong>{$emailTest}</strong> não existe na tabela 'usuarios' da Hostinger. Verifique o phpMyAdmin.</p>");
    }
    
    echo "<p>👤 Usuário localizado no banco: <strong>" . htmlspecialchars($usuario['nome']) . "</strong></p>";
    echo "<p>🔑 Código Hash gravado no MySQL: <code>" . htmlspecialchars($usuario['senha']) . "</code></p>";
    
    if (password_verify($senhaTest, $usuario['senha'])) {
        echo "<p style='color:green; font-weight:bold; font-size:18px;'>✅ password_verify APROVADO! A senha 'admin123' bate perfeitamente com o Hash do banco.</p>";
        
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        echo "<p>👉 Clique aqui para forçar a entrada direto na Dashboard logado: <a href='/admin' style='background:#1e3a8a;color:white;padding:8px 15px;text-decoration:none;border-radius:4px;font-weight:bold;'>Ir para o Painel Admin</a></p>";
    } else {
        echo "<p style='color:red; font-weight:bold;'>❌ REJEITADO: A senha 'admin123' NÃO corresponde ao hash gravado no banco de dados.</p>";
    }
    
} catch (\Throwable $e) {
    echo "<p style='color:red; font-weight:bold;'>💥 Erro Fatal do PHP Capturado:</p>";
    echo "<pre>" . $e->getMessage() . "\nNo arquivo: " . $e->getFile() . " na linha " . $e->getLine() . "</pre>";
}
