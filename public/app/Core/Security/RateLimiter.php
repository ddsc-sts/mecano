<?php
declare(strict_types=1);
namespace App\Core\Security;

/** Limitador simples em arquivo (storage/cache). Em produção, prefira Redis ou tabela login_attempts. */
final class RateLimiter
{
    public static function tooMany(string $key, int $max = 5, int $windowSec = 900): bool
    {
        $file = self::file($key);
        $hits = is_file($file) ? array_filter(array_map('intval', file($file, FILE_IGNORE_NEW_LINES)), fn($t) => $t > time() - $windowSec) : [];
        return count($hits) >= $max;
    }

    public static function hit(string $key): void
    {
        @file_put_contents(self::file($key), time() . "\n", FILE_APPEND | LOCK_EX);
    }

    public static function clear(string $key): void { @unlink(self::file($key)); }

    private static function file(string $key): string
    {
        return BASE_PATH . '/storage/cache/rl_' . hash('sha256', $key) . '.txt';
    }
}
