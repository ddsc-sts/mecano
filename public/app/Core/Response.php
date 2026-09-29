<?php
declare(strict_types=1);
namespace App\Core;

final class Response
{
    public static function redirect(string $to, int $code = 302): never
    {
        header('Location: ' . $to, true, $code);
        exit;
    }

    public static function json(mixed $data, int $code = 200): never
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    public static function abort(int $code): never
    {
        http_response_code($code);
        View::renderError($code);
        exit;
    }
}
