/my-php-frontend-app
│
├── /public
│ ├── index.php # Ponto de entrada da aplicação (exibe a página de login)
│ ├── register.php # Página de registro de usuário
│ ├── home.php # Painel do usuário (após login)
│ ├── profile.php # Exibe dados do perfil do usuário
│ ├── logout.php # Página para realizar logout
│ ├── css # Diretório para arquivos CSS
│ │ └── styles.css # Arquivo de estilo principal
│ ├── js # Diretório para arquivos JavaScript
│ │ └── app.js # Arquivo JavaScript principal
│ └── /images # Diretório para imagens
│
├── /src  
│ ├── /Controllers # Controladores para interagir com a API
│ │ ├── AuthController.php # Controlador de autenticação (consome API de login/logout)
│ │ ├── UserController.php # Controlador para manipular dados do usuário (perfil, etc.)
│ │ └── ApiController.php # Controlador base para requisições à API (curl ou Guzzle)
│ ├── /Models # Modelos que podem refletir a estrutura de dados do usuário
│ │ └── User.php # Modelo para o usuário
│ ├── /Views # Arquivos de visualização
│ │ ├── login.php # Formulário de login
│ │ ├── register.php # Formulário de registro
│ │ ├── home.php # Página do home do usuário
│ │ └── profile.php # Página do perfil do usuário
│ └── /Helpers # Funções auxiliares
│ └── Utils.php # Funções como sanitização de dados, etc.
│
├── /vendor # Diretório do Composer para dependências
│
├── .env # Variáveis de ambiente (URL da API, chaves, etc.)
├── composer.json # Arquivo de configuração do Composer
└── README.md # Documentação do projeto
