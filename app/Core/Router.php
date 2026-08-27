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

        // Limpeza inteligente: Se rodar no XAMPP local, limpa a pasta. Na Hostinger lê direto da raiz.
        $baseDir = '/solucaodigital/public';
        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        $uri = '/' . trim($uri, '/');

        // 1. Verifica se a rota existe no array
        if (isset($this->routes[$method][$uri])) {
            [$controllerClass, $action] = $this->routes[$method][$uri];

            if (!class_exists($controllerClass)) {
                http_response_code(500);
                echo "<h3>Erro: Classe não encontrada</h3><p>{$controllerClass}</p>";
                die();
            }

            $controller = new $controllerClass();
            if (!method_exists($controller, $action)) {
                http_response_code(500);
                echo "<h3>Erro: Método não encontrado</h3><p>{$action}</p>";
                die();
            }

            $controller->$action();
            return;
        }

        // Se a rota não existir, exibe o 404 limpo
        http_response_code(404);
        echo "<h3>Página não encontrada (404)</h3>";
        echo "<p>Rota requisitada: <strong>" . htmlspecialchars($uri) . "</strong></p>";
    }
}
