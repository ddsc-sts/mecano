<?php
declare(strict_types=1);
namespace App\Core\Security;

final class Validator
{
    /** Regras: required, email, min:N, max:N, placa. Retorna [erros por campo]. */
    public static function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleList) {
            $v = trim((string) ($data[$field] ?? ''));
            foreach (explode('|', $ruleList) as $rule) {
                [$name, $arg] = array_pad(explode(':', $rule, 2), 2, null);
                $ok = match ($name) {
                    'required' => $v !== '',
                    'email'    => $v === '' || filter_var($v, FILTER_VALIDATE_EMAIL) !== false,
                    'min'      => $v === '' || mb_strlen($v) >= (int) $arg,
                    'max'      => mb_strlen($v) <= (int) $arg,
                    'placa'    => $v === '' || preg_match('/^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/', strtoupper($v)) === 1,
                    default    => true,
                };
                if (!$ok) { $errors[$field][] = $name; break; }
            }
        }
        return $errors;
    }
}
