<?php

namespace App\Controllers;

use App\Models\categories;
use App\Models\news_sources;


class Portada extends BaseController
{
    protected $session;
    protected $newsSourcesModel;

    public function __construct()
    {
        $this->session = session();

        $this->newsSourcesModel = new news_sources();
    }
    private function getUserData()
    {
        // Obtiene datos del usuario desde la sesión
        $user = $this->session->get('user');
        $data['user'] = $user;
        $data['user_id'] = $user['id'];
        $data['firstname'] = $user['first_name'];
        $data['role'] = $user['role_id'];

        return $data;
    }
    public function mostrarPortada($usuarioId, $nombre, $apellido) {
       
        $data = $this->getUserData();
        $user_id = $data['user_id'];
        $data['allNews'] = $this->newsSourcesModel->getAllNews($user_id);

        return view('portada', $data);
    }
}