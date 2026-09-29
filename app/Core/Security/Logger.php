<?php
declare(strict_types=1);
namespace App\Core\Security;

final class Logger
{
    private static function write(string $file, string $level, string $msg): void
    {
        $dir = BASE_PATH . '/storage/logs';
        if (!is_dir($dir)) return;
        $msg = str_replace(["\r", "\n"], ' ', $msg);   // evita log injection
        $line = sprintf("[%s] %s %s\n", date('c'), strtoupper($level), $msg);
        @file_put_contents("{$dir}/{$file}", $line, FILE_APPEND | LOCK_EX);
    }

    public static function app(string $level, string $msg): void { self::write('app.log', $level, $msg); }
    public static function security(string $event, string $msg = ''): void { self::write('security.log', $event, $msg); }
    public static function audit(string $msg): void { self::write('audit.log', 'audit', $msg); }
}
