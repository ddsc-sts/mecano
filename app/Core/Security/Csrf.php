<?php
declare(strict_types=1);
namespace App\Core\Security;

use App\Core\Session;

final class Csrf
{
    public static function token(): string
    {
        if (!Session::get('_csrf')) Session::set('_csrf', bin2hex(random_bytes(32)));
        return Session::get('_csrf');
    }

    public static function valid(?string $token): bool
    {
        return is_string($token) && hash_equals((string) Session::get('_csrf', ''), $token);
    }
}
