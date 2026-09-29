<?php
declare(strict_types=1);
namespace App\Core;

use App\Core\Security\Logger;

final class ErrorHandler
{
    public static function register(): void
    {
        ini_set('display_errors', '0');
        error_reporting(E_ALL);
        set_exception_handler([self::class, 'handle']);
        set_error_handler(function (int $no, string $str, string $file, int $line): bool {
            throw new \ErrorException($str, 0, $no, $file, $line);
        });
    }

    public static function handle(\Throwable $e): void
    {
        Logger::app('error', $e::class . ': ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
        $debug = Env::get('APP_DEBUG') === 'true';
        http_response_code(500);
        if ($debug) {
            echo '<pre>' . htmlspecialchars((string) $e, ENT_QUOTES, 'UTF-8') . '</pre>';
            return;
        }
        View::renderError(500);
    }
}
