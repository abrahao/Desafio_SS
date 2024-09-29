<?php

require_once 'vendor/autoload.php';
require_once 'config/Database.php';

use Config\Database;

try {
    $db = new Database();
    $connection = $db->connect();
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
