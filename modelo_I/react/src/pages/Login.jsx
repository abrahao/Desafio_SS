import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { loginUser } from "../api/api.js";
import logo from "../assets/logo.png";
import { FaUser, FaLock } from "react-icons/fa";
import "./Login.css";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState("");
  const navigate = useNavigate(); // Inicializa useNavigate

  const handleSubmit = async (e) => {
    e.preventDefault(); // Evita o comportamento padrão do formulário
    try {
      const response = await loginUser(email, password); // Realiza a requisição de login
      if (response.token) {
        localStorage.setItem("token", response.token); // Armazena o token no localStorage
        setMessage("Login realizado com sucesso!"); // Atualiza a mensagem de sucesso
        navigate("/home"); // Redireciona para a página inicial
      } else {
        setMessage(response.message); // Exibe a mensagem de erro vinda da API
      }
    } catch (error) {
      console.error(error);
      setMessage("Credenciais inválidas"); // Exibe mensagem de erro
    }
  };

  return (
    <div className="container">
      <div className="card">
        <main className="conteudo">
          <form onSubmit={handleSubmit}>
            <h1>Entrar</h1>

            <div className="input-group">
              <input
                type="email"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
              <FaUser className="icon" />
            </div>
            <div className="input-group">
              {" "}
              <input
                type="password"
                placeholder="Senha"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
              <FaLock className="icon" />
            </div>
            <button type="submit">Entrar</button>
          </form>
          <img src={logo} alt="SS Digital Logo" />
          {message && <p className="msg">{message}</p>}
        </main>
      </div>
    </div>
  );
};

export default Login;
