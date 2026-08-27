<?php
// Garanta que esta seja a PRIMEIRA linha absoluta do arquivo, colada no topo!
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure' => isset($_SERVER['HTTPS']), // Ativa segurança se rodar em HTTPS
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax'
    ]);
}

// Seu código original de require e rotas continua abaixo...
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';
