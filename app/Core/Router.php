<?php

namespace App\SolucoesDigitais\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Limpeza inteligente: Só limpa subpastas se NÃO estiver na raiz da Hostinger
        $scriptName = $_SERVER['SCRIPT_NAME']; 
        $baseDir = dirname($scriptName);       

        if ($baseDir !== '/' && $baseDir !== '\\' && strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        $uri = '/' . trim($uri, '/');

        // 1. Verifica se o caminho físico da rota está registrado no array
        if (isset($this->routes[$method][$uri])) {
            [$controllerClass, $action] = $this->routes[$method][$uri];

            // 2. Se a classe não for localizada pelo Composer, exibe o diagnóstico real
            if (!class_exists($controllerClass)) {
                http_response_code(500);
                echo "<h3>Erro de Carregamento de Classe</h3>";
                echo "<p>O Roteador encontrou a rota <strong>{$uri}</strong>, mas o Composer não conseguiu localizar o arquivo físico da classe:</p>";
                echo "<code style='background:#eee;padding:5px;display:block;'>{$controllerClass}</code>";
                echo "<p><strong>O que verificar:</strong> Certifique-se de que o <i>namespace</i> no topo do arquivo do Controller corresponde exatamente a este caminho.</p>";
                die();
            }

            // 3. Se a classe existe, mas o método não foi encontrado
            $controller = new $controllerClass();
            if (!method_exists($controller, $action)) {
                http_response_code(500);
                echo "<h3>Erro de Método Não Encontrado</h3>";
                echo "<p>A classe <code style='background:#eee;padding:3px;'>{$controllerClass}</code> foi carregada com sucesso, mas o método abaixo não existe dentro dela:</p>";
                echo "<code style='background:#eee;padding:5px;display:block;'>public function {$action}()</code>";
                die();
            }

            // Se tudo estiver correto, executa a ação normalmente
            $controller->$action();
            return;
        }

        // Se a rota realmente não existir no array, exibe o 404 tradicional
        http_response_code(404);
        echo "<h3>Página não encontrada (404)</h3>";
        echo "<p>Rota requisitada: <strong>" . htmlspecialchars($uri) . "</strong></p>";
        echo "<p>Método: <strong>" . $method . "</strong></p>";
    }
}
