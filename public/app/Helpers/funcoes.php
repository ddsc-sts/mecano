<?php
declare(strict_types=1);

use App\Core\Security\Csrf;

if (!function_exists('e')) {
    function e(mixed $v): string { return htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}
if (!function_exists('csrf_field')) {
    function csrf_field(): string { return '<input type="hidden" name="_csrf" value="' . e(Csrf::token()) . '">'; }
}
if (!function_exists('auth')) {
    function auth(): ?array { return \App\Core\Session::get('usuario'); }
}
