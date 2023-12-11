<?php

namespace App\Controllers;

use App\Models\categories;


class Admin extends BaseController
{
    protected $session;
    protected $newsSourcesModel;

    public function __construct()
    {
        $this->session = session();
    }
    private function getUserData()
    {
        // Obtener datos del usuario desde la sesión
        $user = $this->session->get('user');
        $data['user'] = $user;
        $data['user_id'] = $user['id'];
        $data['firstname'] = $user['first_name'];
        $data['role'] = $user['role_id'];

        return $data;
    }
    public function index(): string
    {
        $data = $this->getUserData();
        $model = new categories();
        $data['categories'] = $model->getCategories();

        $data['dropdown'] = view('dropdown', $data);
        return view('admin_area/categories', $data);
    }

    public function add(): string
    {
        $data = $this->getUserData();
        $data['dropdown'] = view('dropdown', $data);
        return view('admin_area/categories_add',$data);
    }
    public function save()
    {
        $request = service('request');
        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() === 'post') {

            $model = new categories();

            // Obtiene el nombre de la categoría desde la solicitud
            $name = $this->request->getPost('name');

            
            $model->saveCategory($name);

            // Redirige a la página de categorías después de guardar
            return redirect()->to('categories');
        }
    }

    public function edit($id)
    {
    
        $model = new categories();

        // Obtiene la categoría por ID
        $data['categorie'] = $model->find($id);

        $data['dropdown'] = view('dropdown', $data);
        
        return view('admin_area/categories_edit', $data);
    }

    public function save_edit()
    {
        $request = service('request');
        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() === 'post') {
        
            $model = new Categories();

            // Obtiene los datos del formulario
            $id = $this->request->getPost('id');
            $name = $this->request->getPost('name');

            // Actualiza la categoría utilizando la función del modelo
            $model->updateCategory($id, ['name' => $name]);

            // Redirige a la página de categorías después de guardar
            return redirect()->to('categories');
        }
    }
    public function deleteCategory($id)
    {
        
        $model = new Categories();

        // Llama a la función del modelo para eliminar la categoría
        $model->deleteCategory($id);

        // Redirige a la página de categorías después de eliminar
        return redirect()->to('categories');
    }
    public function logout()
    {
        // Inicia la sesión si no se ha iniciado
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruye la sesión
        session_destroy();

        // Redirige a la página de login
        return redirect()->to(base_url('/'));
    }
}
