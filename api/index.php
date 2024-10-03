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
match ($requestUri) {
    '/register' => $requestMethod === 'POST'
    ? $userController->register()
    : (http_response_code(405) && print (json_encode(['message' => 'Método não permitido.']))),

    '/login' => $requestMethod === 'POST'
    ? $authController->login()
    : (http_response_code(405) && print (json_encode(['message' => 'Método não permitido.']))),

    '/logout' => $requestMethod === 'POST'
    ? $authController->logout()
    : (http_response_code(405) && print (json_encode(['message' => 'Método não permitido.']))),

    '/protected-endpoint' => ($jwtMiddleware->handle($_SERVER['REQUEST']) === false)
    ? exit()
    : ($requestMethod === 'GET'
        ? print (json_encode(['message' => 'Acesso permitido ao endpoint protegido.']))
        : (http_response_code(405) && print (json_encode(['message' => 'Método não permitido.'])))),

    '/validate-token' => $requestMethod === 'POST'
    ? ($jwtMiddleware->handle($_SERVER['REQUEST']) === false
        ? exit()
        : print (json_encode(['valid' => true])))
    : (http_response_code(405) && print (json_encode(['message' => 'Método não permitido.']))),

    default => (http_response_code(404) && print (json_encode(['message' => 'Endpoint não encontrado.'])))
};
