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

// Define as rotas da aplicação
switch ($uri) {
    case '/':
        renderView('login');
        break;
    case '/login':
        renderView('login');
        break;
    case '/home':
        // Exibe o painel do usuário, falta implementar verificar se o usuário está autenticado
        renderView('home');
        break;
    case '/logout':
        // Processa o logout (destrói sessão, remove token, etc.)
        require_once __DIR__ . '/../public/logout.php';
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada';
        break;
}
