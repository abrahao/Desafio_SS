<?php

require 'vendor/autoload.php';

use Controllers\UserController;
use Controllers\AuthController;
use Middlewares\JwtMiddleware;

// Inicia os controladores
$authController = new AuthController();
$userController = new UserController();
$jwtMiddleware = new JwtMiddleware();

// Pega a URI sem a query string
$requestUri = strtok($_SERVER['REQUEST_URI'], '?');
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Define o cabeçalho de resposta como JSON
header('Content-Type: application/json');

// Habilita CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Tratar requisições OPTIONS
if ($requestMethod === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Roteamento de requisições
switch ($requestUri) {
    case '/register':
        if ($requestMethod === 'POST') {
            $userController->register();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método não permitido.']);
        }
        break;

    case '/login':
        if ($requestMethod === 'POST') {
            $authController->login();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método não permitido.']);
        }
        break;

    case '/logout':
        if ($requestMethod === 'POST') {
            $authController->logout();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método não permitido.']);
        }
        break;

    case '/protected-endpoint':
        // Protege a rota com o middleware JWT
        $jwtMiddlewareResponse = $jwtMiddleware->handle($_SERVER['REQUEST']);
        if ($jwtMiddlewareResponse === false) {
            // O middleware já enviou uma resposta, portanto não é necessário fazer nada aqui
            exit();
        }

        if ($requestMethod === 'GET') {
            echo json_encode(['message' => 'Acesso permitido ao endpoint protegido.']);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método não permitido.']);
        }
        break;
    case '/validate-token':
        if ($requestMethod === 'POST') {
            $jwtMiddlewareResponse = $jwtMiddleware->handle($_SERVER['REQUEST']);
            if ($jwtMiddlewareResponse === false) {
                // O middleware já enviou uma resposta
                exit();
            }
            // Se o token for válido, retornamos uma resposta positiva
            echo json_encode(['valid' => true]);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método não permitido.']);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint não encontrado.']);
        break;
}
