<?php
declare(strict_types=1);
namespace App\Core;

final class View
{
    /** Renderiza app/Views/{view}.php dentro de um layout. Use e() para escapar saída. */
    public static function render(string $view, array $data = [], string $layout = 'oficina'): void
    {
        $content = self::capture($view, $data);
        $layoutFile = BASE_PATH . "/app/Views/layouts/{$layout}.php";
        require $layoutFile;
    }

    public static function renderError(int $code): void
    {
        $file = BASE_PATH . "/app/Views/errors/{$code}.php";
        if (is_file($file)) { require $file; return; }
        echo "Erro {$code}";
    }

    private static function capture(string $view, array $data): string
    {
        $file = BASE_PATH . '/app/Views/' . str_replace(['..', "\0"], '', $view) . '.php';
        if (!is_file($file)) throw new \RuntimeException("View não encontrada: {$view}");
        extract($data, EXTR_SKIP);
        ob_start();
        require $file;
        return (string) ob_get_clean();
    }
}
