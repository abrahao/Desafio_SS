import { Navigate } from "react-router-dom";
import PropTypes from "prop-types";
import { useEffect, useState } from "react";

// Componente de rota protegida
const ProtectedRoute = ({ children }) => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [loading, setLoading] = useState(true); // Estado para controlar a verificação do token

  useEffect(() => {
    // Verifica se há um token armazenado no localStorage
    const token = localStorage.getItem("token");

    // Atualiza o estado de autenticação com base na existência do token
    if (token) {
      setIsAuthenticated(true);
    } else {
      setIsAuthenticated(false);
    }
    setLoading(false); // Conclui o processo de verificação
  }, []);

  // Exibe um loading enquanto verifica o token
  if (loading) {
    return <div>Carregando...</div>;
  }

  // Redireciona para a página de login se não estiver autenticado
  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  // Renderiza o componente filho se estiver autenticado
  return children;
};

// Validação de Props
ProtectedRoute.propTypes = {
  children: PropTypes.node.isRequired, // children deve ser um nó React
};

export default ProtectedRoute;
