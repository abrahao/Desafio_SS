<?php

namespace Controllers;

use Models\User;
use Helpers\Utils;
use Firebase\JWT\JWT;
use PDOException;
use Dotenv\Dotenv;

class AuthController
{
    private $jwtSecret;

    public function __construct()
    {
        // Carregar as variáveis de ambiente
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Definir a chave secreta JWT
        $this->jwtSecret = $_ENV['JWT_SECRET'];
    }

    // Método responsavel por processar o login
    public function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = Utils::sanitizeInput($data['email'] ?? '');
        $password = Utils::sanitizeInput($data['password'] ?? '');

        if (empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['message' => 'E-mail e senha são obrigatórios.']);
            return;
        }

        try {
            // Verifica se o usuário existe
            $user = User::findByEmail($email);
            if (!$user || !Utils::verifyPassword($password, $user['password'])) {
                http_response_code(401); // Não autorizado
                echo json_encode(['message' => 'Credenciais inválidas.']);
                return;
            }

            // Gera um token JWT após o login bem-sucedido
            $iat = time(); // Data de criação do token
            $timezone = date_default_timezone_get();
            $token = JWT::encode([
                'name' => $user['name'],
                'email' => $user['email'],
                'iat' => $iat, // Data e hora de criação
                'exp' => $iat + 3600 // Data de expiração
            ], $this->jwtSecret, 'HS256');

            http_response_code(200);
            echo json_encode([
                'message' => 'Login realizado com sucesso.',
                'token' => $token,
                'name' => $user['name'],
                'created_at' => (new \DateTime())->setTimestamp($iat)->format('d/m/Y, H:i:s') // Data de criação do token
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Método de logout 
    public function logout(): void
    {
        // O logout em JWT normalmente é apenas uma questão de não usar mais o token.
        // o token deve ser detruido
        http_response_code(200);
        echo json_encode(['message' => 'Logout realizado com sucesso.']);
    }
}
