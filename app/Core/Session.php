<?php
declare(strict_types=1);
namespace App\Core;

final class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) return;
        $dir = BASE_PATH . '/storage/sessions';
        if (is_dir($dir)) session_save_path($dir);
        session_name('MECANOSESS');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => (Env::get('APP_ENV') === 'production'),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        session_start();

        $ttl = (int) Env::get('SESSION_LIFETIME', 7200);
        if (isset($_SESSION['_last']) && time() - $_SESSION['_last'] > $ttl) {
            self::destroy();
            session_start();
        }
        $_SESSION['_last'] = time();
    }

    public static function get(string $k, mixed $d = null): mixed { return $_SESSION[$k] ?? $d; }
    public static function set(string $k, mixed $v): void { $_SESSION[$k] = $v; }
    public static function forget(string $k): void { unset($_SESSION[$k]); }
    public static function regenerate(): void { session_regenerate_id(true); }

    public static function flash(string $k, mixed $v = null): mixed
    {
        if ($v !== null) { $_SESSION['_flash'][$k] = $v; return null; }
        $val = $_SESSION['_flash'][$k] ?? null;
        unset($_SESSION['_flash'][$k]);
        return $val;
    }

    public static function destroy(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }
}
