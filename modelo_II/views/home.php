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
            const username = localStorage.getItem("username");
            const loginTime = localStorage.getItem("loginTime");

            if (username) {
                document.getElementById("username").textContent = username;
            }
            if (loginTime) {
                const date = new Date(parseInt(loginTime)); // Converte loginTime diretamente em milissegundos
                document.getElementById("loginTime").textContent = date.toLocaleString('pt-BR');
            }

            console.log('Nome do usuário:', username);
            console.log('Data e hora de login:', loginTime);
        });

    </script>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card w-50">
            <div class="card-body">
                <h1>Bem-vindo(a), <span id="username"></span>!</h1>
                <p>Você está logado desde <span id="loginTime"></span>.</p>
                <button type="button" class="btn btn-danger" onclick="logout()">Sair</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>