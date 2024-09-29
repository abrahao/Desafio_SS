<?php

namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private string $secretKey;

    public function __construct()
    {
        $this->secretKey = $_ENV['JWT_SECRET'];
    }

    // Gerar token JWT
    public function gerarToken(string $name, string $email): string
    {
        $payload = [
            'iss' => 'http://localhost',
            'aud' => 'http://localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                'name' => $name,
                'email' => $email
            ]
        ];

        error_log(json_encode($payload));

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }


    // Validar token JWT
    public function validateToken(string $token): object
    {
        return JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }
}
