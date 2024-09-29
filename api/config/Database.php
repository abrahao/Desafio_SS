<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    // Função para conectar ao banco de dados, captrura as credencaisdo .env
    public function connect(): PDO
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $port = $_ENV['DB_PORT'];

        try {
            return new PDO("pgsql:host=$host;port=$port;dbname=$dbName", $username, $password);
        } catch (PDOException $e) {
            throw new PDOException('Erro na conexão: ' . $e->getMessage());
        }
    }
}
