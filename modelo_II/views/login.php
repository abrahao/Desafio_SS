<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow" style="width: 22rem;">
            <h1 class="text-center mb-4">Entrar</h1>
            <form id="loginForm">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div id="errorMessage" class="alert alert-danger mt-3 d-none"></div>
            <div class="text-center mt-4">
                <img src="assets/img/logo.png" alt="Logo" class="img-fluid logo">
            </div>
        </div>
    </div>
    <script>
        document.getElementById("loginForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            const formData = new FormData(this);
            const data = {
                email: formData.get("email"),
                password: formData.get("password"),
            };

            fetch("http://localhost:8000/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => {
                    console.log("Resposta do fetch:", response); // Log da resposta do fetch
                    return response.json();
                })
                .then((data) => {
                    console.log("Resposta do servidor:", data); // Exibe a resposta do servidor no console
                    if (data.token) {
                        const tokenPayload = JSON.parse(atob(data.token.split(".")[1])); // Decodifica o token JWT
                        console.log("Payload decodificado:", tokenPayload);

                        const loginTime = Date.now(); // Usa a hora atual como timestamp

                        // Armazena o token e a data/hora de login no localStorage
                        localStorage.setItem("jwtToken", data.token);
                        localStorage.setItem("loginTime", loginTime); // Armazena a hora atual

                        // Redireciona para a página inicial
                        window.location.href = "/home";
                    } else {
                        // Exibe mensagem de erro na própria tela
                        const errorMessage = document.getElementById("errorMessage");
                        errorMessage.textContent = data.message;
                        errorMessage.classList.remove("d-none");
                    }
                })
                .catch((error) => {
                    console.error("Erro ao fazer login:", error);
                    const errorMessage = document.getElementById("errorMessage");
                    errorMessage.textContent = "Erro ao tentar fazer login. Tente novamente.";
                    errorMessage.classList.remove("d-none");
                });
        });

        function isAuthenticated() {
            const token = localStorage.getItem("jwtToken");
            return token !== null;
        }

        function redirectToLoginIfNotAuthenticated() {
            // Redireciona apenas se não estiver autenticado e não estiver na página de login
            if (!isAuthenticated() && window.location.pathname !== "/login") {
                window.location.href = "/login"; // Redireciona para a página de login
            }
        }

        function logout() {
            localStorage.removeItem("jwtToken");
            localStorage.removeItem("loginTime"); // Remove a data/hora de login
            window.location.href = "/login"; // Redireciona para a página de login
        }

        // Verifica se o usuário está autenticado
        redirectToLoginIfNotAuthenticated();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>