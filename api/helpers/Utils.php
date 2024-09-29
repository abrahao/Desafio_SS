<?php

namespace Helpers;

class Utils
{

    // Gera um hash seguro para a senha utilizando o algoritmo bcrypt.
    public static function hashPassword(string $password): string
    {
        // Criptografa a senha usando o algoritmo BCRYPT
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Verifica se a senha fornecida corresponde ao hash armazenado.

    public static function verifyPassword(string $password, string $hashedPassword): bool
    {
        // Verifica se a senha fornecida corresponde ao hash armazenado
        return password_verify($password, $hashedPassword);
    }

    // Gera um identificador único (hash) para uso geral.

    public static function generateHash(): string
    {
        // Gera um hash usando openssl_random_pseudo_bytes e converte em um formato legível
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    // Função utilitária para limpar dados recebidos via JSON ou POST
    public static function sanitizeInput($data)
    {
        // Remove espaços e caracteres indesejados para prevenir ataques XSS
        if (is_array($data)) {
            return array_map('self::sanitizeInput', $data);
        }

        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
