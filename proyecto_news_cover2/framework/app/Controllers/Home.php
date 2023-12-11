<?php

namespace App\Controllers;

use App\Models\user;

class Home extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = session();

    }
    public function index(): string
    {
        $user = $this->session->get('user');
        $data['user'] = $user;

        $data['dropdown'] = view('dropdown');

        return view('login', $data);
    }
    public function valid()
    {
        
        $request = service('request');

        if ($request->getMethod() === 'post') {
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            
            $model = new User();

            // Llamada a la función authenticate del modelo User
            $user = $model->authenticate($email, $password);

            if ($user) {
                $session = session();
                $session->set('user', $user);

                if ($user['role_id'] === '1') {
                    return redirect()->to(route_to('categories'));
                } else {
                    return redirect()->to('dashboard');
                }
            } else {
                return redirect()->to('/');
            }
        }
    }

}

?>