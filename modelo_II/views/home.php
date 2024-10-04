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
            localStorage.removeItem("loginTime"); // Remove a data/hora de login
            window.location.href = "/login"; // Redireciona para a página de login
        }

        // Decodifica o JWT para pegar as informações do usuário
        function decodeJWT(token) {
            const base64Url = token.split('.')[1]; // Pega o payload
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));

            return JSON.parse(jsonPayload);
        }

        // Verifica se o usuário está autenticado
        redirectToLoginIfNotAuthenticated();

        document.addEventListener("DOMContentLoaded", function () {
            const token = localStorage.getItem("jwtToken"); // Recupera o token do localStorage
            const loginTime = localStorage.getItem("loginTime");

            if (token) {
                const decodedToken = decodeJWT(token); // Decodifica o token JWT
                document.getElementById("username").textContent = decodedToken.name; // Exibe o nome do usuário
            }
            if (loginTime) {
                const date = new Date(parseInt(loginTime)); // Converte o timestamp para data
                document.getElementById("loginTime").textContent = date.toLocaleString('pt-BR'); // Formata a data em pt-BR
            }
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