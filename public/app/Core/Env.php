<?php
declare(strict_types=1);
namespace App\Core;

final class Env
{
    private static array $vars = [];

    public static function load(string $file): void
    {
        if (!is_file($file)) return;
        foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) continue;
            [$k, $v] = explode('=', $line, 2);
            $v = trim(preg_replace('/\s+#.*$/', '', $v), " \t\"'");
            self::$vars[trim($k)] = $v;
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$vars[$key] ?? $default;
    }
}
