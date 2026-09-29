<?php
declare(strict_types=1);
namespace App\Core;

final class Request
{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $query,
        public readonly array $body,
        public readonly array $files,
        public readonly string $ip,
        public array $params = []
    ) {}

    public static function capture(): self
    {
        $path = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        return new self($method, '/' . trim($path, '/'), $_GET, $_POST, $_FILES, $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }
}
