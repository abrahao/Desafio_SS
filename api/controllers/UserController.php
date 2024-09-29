<?php

namespace Controllers;

use Models\User;
use Helpers\Utils;
use PDOException;

class UserController
{
    // Método de cadastro de usuario
    public function register(): void
    {
        // Obtém os dados enviados via JSON
        $data = json_decode(file_get_contents('php://input'), true);

        // Sanitiza as entradas para remover caracteres indesejados
        $name = Utils::sanitizeInput($data['name'] ?? '');
        $email = Utils::sanitizeInput($data['email'] ?? '');
        $password = Utils::sanitizeInput($data['password'] ?? '');

        // Verifica se todos os campos estão preenchidos
        if (empty($name) || empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['message' => 'Todos os campos são obrigatórios.']);
            return;
        }

        try {
            // Verifica se o usuário já existe pelo e-mail
            if (User::findByEmail($email)) {
                http_response_code(409); // Conflito (usuário já cadastrado)
                echo json_encode(['message' => 'Usuário já cadastrado com este e-mail.']);
                return;
            }

            // Criptografa a senha antes de armazená-la
            $hashedPassword = Utils::hashPassword($password);

            // Cria um novo usuário
            $user = new User($name, $email, $hashedPassword);
            $user->save();

            http_response_code(201); // Status 201 (Criado)
            echo json_encode(['message' => 'Usuário cadastrado com sucesso.']);
        } catch (PDOException $e) {
            http_response_code(500); // Erro interno do servidor
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
