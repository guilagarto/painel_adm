<?php
// Ativa a exibição de erros na tela para monitorarmos o reset
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Importa a classe de conexão com o banco de dados que já criamos
require_once __DIR__ . '/../app/Core/Database.php';

use App\SolucoesDigitais\Core\Database;

try {
    $db = Database::getConnection();

    // 1. Defina aqui qual e-mail você quer usar para acessar o painel
    $emailAcesso = "admin@8ou80.com"; 
    
    // 2. Gera o hash criptográfico profissional que o password_verify() exige
    $senhaNovaSegura = password_hash("80u80admin", PASSWORD_DEFAULT);

    // 3. Atualiza a senha e garante que o usuário existe no banco de dados da Hostinger
    $stmtCheck = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmtCheck->execute(['email' => $emailAcesso]);
    $usuario = $stmtCheck->fetch();

    if ($usuario) {
        // Se o e-mail já existir, apenas sobrescreve a senha com a criptografia correta
        $stmtUpdate = $db->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $stmtUpdate->execute(['senha' => $senhaNovaSegura, 'email' => $emailAcesso]);
        echo "<h3>✅ Sucesso!</h3><p>A senha do usuário <strong>{$emailAcesso}</strong> foi redefinida com a criptografia correta.</p>";
    } else {
        // Se o e-mail não existir por algum motivo, ele cria o usuário do zero na hora
        $stmtInsert = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES ('Administrador 80u80', :email, :senha)");
        $stmtInsert->execute(['email' => $emailAcesso, 'senha' => $senhaNovaSegura]);
        echo "<h3>✅ Sucesso!</h3><p>O usuário <strong>{$emailAcesso}</strong> não existia e foi criado do zero com a criptografia correta.</p>";
    }

    echo "<p><strong>Novas credenciais de login para usar na internet:</strong><br>";
    echo "📧 E-mail: <code>{$emailAcesso}</code><br>";
    echo "🔑 Senha: <code>80u80admin</code></p>";
    echo "<p style='color:red;'>⚠️ <strong>IMPORTANTE:</strong> Após conseguir logar, delete o arquivo <u>public/recuperar.php</u> do seu projeto por segurança!</p>";

} catch (\Exception $e) {
    echo "<h3>❌ Erro ao redefinir:</h3>" . $e->getMessage();
}
