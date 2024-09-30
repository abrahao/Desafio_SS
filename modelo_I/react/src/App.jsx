import { useState, useEffect } from "react";
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from "react-router-dom";
import Login from "./pages/Login";
import Home from "./pages/Home";
import ProtectedRoute from "./components/ProtectedRoute";

const App = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false); // Estado de autenticação

  useEffect(() => {
    // Verifica se o token existe no localStorage
    const token = localStorage.getItem("token");
    if (token) {
      setIsAuthenticated(true); // Se o token existir, o usuário está autenticado
    }
  }, []); // Executa apenas uma vez ao montar o componente

  const handleLogin = () => {
    setIsAuthenticated(true); // Atualiza o estado para autenticado
  };

  const handleLogout = () => {
    setIsAuthenticated(false); // Atualiza o estado para não autenticado
  };

  return (
    <Router>
      <Routes>
        <Route path="/login" element={<Login onLogin={handleLogin} />} />
        <Route
          path="/home"
          element={
            <ProtectedRoute isAuthenticated={isAuthenticated}>
              <Home onLogout={handleLogout} />{" "}
              {/* Passa a função de logout para Home */}
            </ProtectedRoute>
          }
        />
        <Route path="/" element={<Navigate to="/login" />} />
      </Routes>
    </Router>
  );
};

export default App;
