const API_URL = "http://localhost:8000/login";

// Função para registrar um novo usuário
export const registerUser = async (name, email, password) => {
  try {
    const response = await fetch(`${API_URL}/register`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name, email, password }),
    });

    if (!response.ok) {
      throw new Error("Erro ao registrar o usuário");
    }

    const data = await response.json(); // Converte a resposta para JSON
    return data;
  } catch (error) {
    console.error("Erro ao registrar o usuário:", error);
    throw error; // Propaga o erro para ser tratado onde a função for chamada
  }
};

// Função para fazer login
export const loginUser = async (email, password) => {
  try {
    const response = await fetch(`${API_URL}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email, password }),
    });

    if (!response.ok) {
      throw new Error("Erro ao fazer login");
    }

    const data = await response.json(); // Converte a resposta para JSON
    console.log("Token recebido:", data.token); // Exibe o token no console

    // Decodifica o token JWT e verifica se as propriedades existem antes de acessá-las
    const tokenPayload = JSON.parse(atob(data.token.split(".")[1]));
    console.log("Payload decodificado:", tokenPayload);

    const username = tokenPayload.name || "Nome não encontrado";
    const loginTime = tokenPayload.iat || Date.now() / 1000;

    // Armazena o token, o nome e a data/hora de login no localStorage
    console.log("username:", username); // Exibe o nome do usuário no console
    console.log(
      "loginTime:",
      new Date(loginTime * 1000).toLocaleString("pt-BR")
    ); // Exibe a data e hora de login no console

    return data;
  } catch (error) {
    console.error("Erro ao fazer login:", error);
    throw error;
  }
};

// Função para acessar um endpoint protegido
// ainda a ser ajustado
export const getProtectedData = async (token) => {
  try {
    const response = await fetch(`${API_URL}/protected-endpoint`, {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`, // Passa o token JWT no cabeçalho
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      throw new Error("Erro ao acessar o endpoint protegido");
    }

    const data = await response.json(); // Converte a resposta para JSON
    return data;
  } catch (error) {
    console.error("Erro ao acessar o endpoint protegido:", error);
    throw error;
  }
};
