<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>
    <script>
        function isAuthenticated() {
            const token = localStorage.getItem("jwtToken");
            return token !== null;
        }

        function redirectToLoginIfNotAuthenticated() {
            if (!isAuthenticated() && window.location.pathname !== "/login") {
                window.location.href = "/login"; // Redireciona para a página de login
            }
        }

        function logout() {
            localStorage.removeItem("jwtToken");
            localStorage.removeItem("username"); // Remove o nome do usuário do localStorage
            localStorage.removeItem("loginTime"); // Remove a data/hora de login
            window.location.href = "/login"; // Redireciona para a página de login
        }

        // Verifica se o usuário está autenticado
        redirectToLoginIfNotAuthenticated();

        document.addEventListener("DOMContentLoaded", function () {
            const username = localStorage.getItem("username"); // Recupera o nome do usuário do localStorage
            const loginTime = localStorage.getItem("loginTime");

            if (username) {
                document.getElementById("username").textContent = username; // Exibe o nome do usuário
            }
            if (loginTime) {
                const date = new Date(loginTime * 1000); // Converte o timestamp para data
                document.getElementById("loginTime").textContent = date.toLocaleString('pt-BR'); // Formata a data em pt-BR
            }
            console.log('Nome do usuário:', username); // Mostra o nome do usuário no console
            console.log('Data e hora de login:', loginTime); // Mostra a data/hora de login no console
        });
    </script>
</head>

<body>
    <h1>Bem-vindo(a), <span id="username"></span>!</h1>
    <p>Você está logado desde <span id="loginTime"></span>.</p>
    <button type="button" class="btn btn-primary" onclick="logout()">Sair</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>