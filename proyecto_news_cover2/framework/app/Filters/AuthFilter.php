<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verifica la sesión del usuario
        $session = session();
        $user = $session->get('user');

        if (!$user) {
            // Redirige a la página de inicio de sesión si no hay sesión
            return redirect()->to('login');
        }

        // Continúa con la ejecución del controlador
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Realiza acciones después de la ejecución del controlador si es necesario
    }
}
?>