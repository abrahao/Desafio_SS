<?php
// app-client/middleware.php

session_start();

require_once __DIR__ . '/../vendor/autoload.php'; // Ajuste o caminho conforme necessário

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function checkAuth()
{
    if (!isset($_SESSION['jwt'])) {
        header('Location: /login'); // Redireciona para a página de login
        exit();
    }

    $jwt = $_SESSION['jwt'];
    $secretKey = $_ENV['JWT_SECRET']; // Usar a chave secreta da variável de ambiente

    try {
        $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));

        // Verificações adicionais, se necessário
        if (!$decoded) {
            throw new Exception('Token inválido');
        }

    } catch (Exception $e) {
        header('Location: /login'); // Redireciona para a página de login
        exit();
    }
}
