<?php
// Ativa os erros para garantir que veremos se falhar
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Carrega a conexão com o banco de dados
require_once __DIR__ . '/../app/Core/Database.php';
use App\SolucoesDigitais\Core\Database;

try {
    $db = Database::getConnection();

    // 1. Limpa a tabela para não dar erro de e-mail duplicado
    $db->exec("TRUNCATE TABLE usuarios");

    // 2. Cria a senha criptografada perfeita pelo próprio PHP do seu servidor
    $senhaCriptografada = password_hash('123456', PASSWORD_DEFAULT);

    // 3. Prepara a inserção segura
    $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->execute([
        'nome'  => 'Administrador 80u80',
        'email' => 'admin@80u80.com',
        'senha' => $senhaCriptografada
    ]);

    echo "<h3>Sucesso!</h3>O usuário administrador foi reinserido com a senha <strong>123456</strong> perfeitamente criptografada.";
} catch (Exception $e) {
    echo "<h3>Erro ao gerar usuário:</h3>" . $e->getMessage();
}
