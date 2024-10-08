import { useNavigate } from "react-router-dom";
import Button from "../components/Button";

const Home = () => {
  const navigate = useNavigate();

  // obtem o token do localStorage
  const token = localStorage.getItem("token");

  let username = "Usuário não encontrado"; // Nome do usuário padrão
  let loginTime = "Data não especificada."; // Data padrão

  // Decodifica o token se ele existir
  if (token) {
    const tokenPayload = JSON.parse(atob(token.split(".")[1]));
    username = tokenPayload.name || username; // obtem o nome do payload
    const loginTimestamp = tokenPayload.iat; // obtem o timestamp de login
    loginTime = loginTimestamp
      ? new Date(loginTimestamp * 1000).toLocaleString("pt-BR")
      : loginTime; // Formata a data
  }

  const handleLogout = () => {
    // Remove o token do localStorage
    localStorage.removeItem("token");

    // Redireciona o usuário para a página de login
    navigate("/login");
  };

  return (
    <div>
      <h1>Bem-vindo, {username}!</h1>
      <p>Você está logado desde {loginTime}</p> {/* Exibindo a data do login */}
      <Button text="Sair" onClick={handleLogout} />
    </div>
  );
};

export default Home;
