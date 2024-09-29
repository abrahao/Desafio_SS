<?php

/*
 serve para interceptar requisições HTTP, verificar a presença e 
 validade de um token JWT no cabeçalho Authorization, 
 e permitir ou negar o acesso com base na validade desse token. 
 Se o token for inválido, expirado, ou não fornecido, o acesso é negado.
*/

namespace Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle($request)
    {
        $headers = $request->getHeaders();

        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
            // Log do token
            error_log("Token recebido: " . $token);

            try {
                // Decodifica o token
                $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
                // Acesso ao próximo controlador ou ação
                return $decoded;
            } catch (ExpiredException $e) {
                http_response_code(401);
                echo json_encode(['message' => 'Token expirado.']);
                return false;
            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(['message' => 'Token inválido.']);
                return false;
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Token não fornecido.']);
            return false;
        }
    }

}
