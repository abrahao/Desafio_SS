<?php

// Função para carregar a view
function renderView($view, $data = [])
{
    // Extrai os dados passados para a view
    extract($data);

    include __DIR__ . '/../views/' . $view . '.php';
}

// Pega a rota atual (URL)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Define as rotas da aplicação usando match
match ($uri) {
    '/' => renderView('login'),
    '/login' => renderView('login'),
    '/home' => renderView('home'), // Falta implementar verificação de autenticação
    '/logout' => require_once __DIR__ . '/../public/logout.php',
    default => (http_response_code(404) && print ('Página não encontrada')),
};
