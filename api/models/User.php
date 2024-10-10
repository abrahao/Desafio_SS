<?php

namespace Models;

use Config\Database;
use PDO;
use PDOException;

class User
{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    // Método para salvar o usuário no banco de dados
    public function save(): bool
    {
        try {
            $db = (new Database())->connect();
            $stmt = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException('Erro ao salvar o usuário: ' . $e->getMessage());
        }
    }

    // Método estático para buscar um usuário pelo e-mail
    public static function findByEmail(string $email): ?array
    {
        try {
            $db = (new Database())->connect();
            $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: null;
        } catch (PDOException $e) {
            throw new PDOException('Erro ao buscar o usuário: ' . $e->getMessage());
        }
    }

    // lista todos os usuarios
    public static function findAll(): array
    {
        try {
            $db = (new Database())->connect();
            $stmt = $db->query('SELECT * FROM users');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users ?: [];
        } catch (PDOException $e) {
            throw new PDOException('Erro ao buscar os usuários: ' . $e->getMessage());
        }
    }
}
