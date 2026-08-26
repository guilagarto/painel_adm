<?php

namespace App\SolucoesDigitais\Core;

class Controller
{
    /**
     * Renderiza uma view embutida dentro de um layout específico de forma independente.
     */
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        // Transforma chaves do array em variáveis para o HTML
        extract($data);

        // dirname(__DIR__, 2) sobe 2 níveis a partir de app/Core/ e chega direto na raiz do projeto
        $baseProjectDir = dirname(__DIR__, 2);
        
        // Monta os caminhos de forma totalmente independente de constantes globais
        $viewFile = $baseProjectDir . '/app/Views/' . $view . '.php';
        $layoutFile = $baseProjectDir . '/app/Views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            die("<h3>Erro de Arquivo</h3>O arquivo da View não existe neste caminho absoluto:<br><br><code style='background:#eee;padding:5px;'>{$viewFile}</code>");
        }

        if (file_exists($layoutFile)) {
            require_once $layoutFile;
        } else {
            require_once $viewFile;
        }
    }
}
