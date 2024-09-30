<?php
// Destroi a sessão do usuário
session_start();
session_destroy();

// Redireciona para a página de login
header("Location: /login");
exit;
