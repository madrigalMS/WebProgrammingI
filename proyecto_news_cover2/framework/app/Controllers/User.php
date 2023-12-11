<?php

namespace App\Controllers;

use App\Models\news_sources;
use App\Models\categories;

class User extends BaseController
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
        $data['lastname'] = $user['last_name'];
        $data['role'] = $user['role_id'];

        return $data;
    }
    public function index()
    {
        $data = $this->getUserData();

        $user_id = $data['user_id'];

        // Verifica si se ha pasado un ID de usuario (por ejemplo, desde "Portada")
        if ($this->request->getGet('user_id')) {
            $user_id = $this->request->getGet('user_id');

            // Obtiene todas las noticias para el usuario
            $data['allNews'] = $this->newsSourcesModel->getAllNews($user_id);

            // Restablece el ID de la categoría seleccionada en la sesión
            $this->session->remove('selectedCategoryId');

            // Limpia la variable en el caso de que haya una categoría seleccionada en la sesión
            unset($data['selectedCategoryId']);
        }

        // Obtener las fuentes de noticias del usuario
        $data['news_sources'] = $this->newsSourcesModel->getUserNewsSources($user_id);

        // Verificar si el usuario tiene fuentes de noticias
        if (empty($data['news_sources'])) {
            // Redirigir a la función 'add' en lugar de 'user_area/news_sources'
            return $this->add();
        }

        // Verificar si el usuario tiene noticias
        $data['user_has_news'] = $this->newsSourcesModel->userHasNews($user_id);

        if (!$data['user_has_news']) {
            $data['message'] = "Lo lamentamos, aún no se han actualizado las noticias.";

            // Mostrar un mensaje de alerta en JavaScript y llamar a la función news_sources
            echo '<script>';
            echo 'alert("' . $data['message'] . '");';
            echo '</script>';

            // Llamar a la función news_sources directamente
            return $this->news_sources();
        }

        // Obtener todas las noticias del usuario
        $data['allNews'] = $this->newsSourcesModel->getAllNews($user_id);

        // Configurar la URL del usuario
        $data['portadaURL'] = site_url("portada/{$user_id}/{$data['firstname']}/{$data['lastname']}");

        // Pasa el ID de la categoría seleccionada a la vista
        $data['selectedCategoryId'] = $this->session->get('selectedCategoryId');

        // Si hay una categoría seleccionada, obtén las categorías correspondientes
        if ($data['selectedCategoryId'] !== null) {
            $categoriesModel = new Categories();
            $data['userCategoriesNews'] = $this->newsSourcesModel->getUserCategoriesNews($user_id);
            $userCategoryIds = array_column($data['userCategoriesNews'], 'category_id');
            $data['categories'] = $categoriesModel->getCategoriesByIds($userCategoryIds);

            // Obtener las noticias para la categoría seleccionada
            $data['allNews'] = $this->newsSourcesModel->getNewsByCategoryId($data['selectedCategoryId'], $user_id);

            $data['etiquetasPorCategoria'] = $this->newsSourcesModel->obtenerEtiquetasPorCategoriaYUsuario($user_id, $data['selectedCategoryId']);
        } else {
            // Si no hay una categoría seleccionada, obtener todas las categorías
            $categoriesModel = new Categories();
            $data['userCategoriesNews'] = $this->newsSourcesModel->getUserCategoriesNews($user_id);
            $userCategoryIds = array_column($data['userCategoriesNews'], 'category_id');
            $data['categories'] = $categoriesModel->getCategoriesByIds($userCategoryIds);
        }

        // Lógica de búsqueda por palabra clave
        $keyword = $this->request->getGet('keyword');
        if (!empty($keyword)) {
            $data['allNews'] = $this->newsSourcesModel->searchNewsByKeyword($user_id, $keyword);
        }

        // Lógica de filtrado por etiquetas
        if ($this->request->getPost('tags')) {
            // Obtener las etiquetas seleccionadas
            $selectedTags = $this->request->getPost('tags');

            // Llamar a la función que realiza la búsqueda en la base de datos
            $data['allNews'] = $this->newsSourcesModel->buscarNoticiasPorEtiquetas($user_id, $selectedTags);
        }

        $data['dropdown'] = view('dropdown', $data);
        // Cargar la vista principal
        return view('dashboard', $data);
    }


    public function selectCategory($categoryId)
    {
        // Almacena el ID de la categoría seleccionada en la sesión
        $this->session->set('selectedCategoryId', $categoryId);

        // Recarga la vista principal
        return redirect()->to('dashboard');
    }
    public function add(): string
    {
        $data = $this->getUserData();
        $model = new categories();
        $data['categories'] = $model->getCategories();

        $data['dropdown'] = view('dropdown', $data);
        return view('user_area/news_sources_add', $data);
    }
    public function save()
    {
        $request = service('request');

        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() === 'post') {
            // Obtiene los datos del formulario
            $data = [
                'user_id' => $this->session->get('user')['id'],
                'category_id' => $this->request->getPost('category'),
                'name' => $this->request->getPost('name'),
                'url' => $this->request->getPost('url'),
            ];

            // Guarda la nueva fuente de noticias utilizando la función del modelo
            $this->newsSourcesModel->insertNewsSource($data);

            // Redirigir de nuevo a la página de fuentes de noticias
            return redirect()->to('news_sources');
        }
    }

    public function edit($id)
    {

        $model = new categories();
        $data = $this->getUserData();

        // Obtener categorías
        $data['categories'] = $model->getCategories();

        // Obtener fuente de noticias por ID
        $data['news_sources'] = $this->newsSourcesModel->find($id);

        $data['dropdown'] = view('dropdown', $data);
        // Carga la vista de edición
        return view('user_area/news_sources_edit', $data);
    }

    public function save_edit()
    {
        $request = service('request');
        if ($request->getMethod() === 'post') {
            // Validar las reglas del formulario (puedes ajustarlas según tus necesidades)
            $rules = [
                'name' => 'required',
                'url' => 'required|valid_url',
                'category' => 'required',
            ];

            if (!$this->validate($rules)) {
                // En caso de errores de validación, redirigir con los errores y los datos anteriores
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Obtener los datos del formulario
            $data = [
                'id' => $this->request->getPost('id'),
                'name' => $this->request->getPost('name'),
                'url' => $this->request->getPost('url'),
                'category_id' => $this->request->getPost('category'),
            ];

            // Guardar los cambios utilizando el modelo
            $this->newsSourcesModel->save($data);

            // Redirigir a la página de fuentes de noticias después de guardar
            return redirect()->to('news_sources');
        }
    }
    public function deleteNewsSource($id)
    {

        // Llama a la función del modelo para eliminar la categoría
        $this->newsSourcesModel->deleteNewsSurces($id);

        // Redirige a la página de categorías después de eliminar
        return redirect()->to('news_sources');
    }

    public function news_sources()
    {
        $data = $this->getUserData();
        // Accede al id del usuario desde la sesión
        $userId = $this->session->get('user')['id'];

        // Obtiene las fuentes de noticias del usuario específico
        $data['news_sources'] = $this->newsSourcesModel->getUserNewsSources($userId);

        $data['dropdown'] = view('dropdown', $data);
        // Cargar la vista y pasar los datos
        return view('user_area/news_sources', $data);
    }
    public function logout()
    {
        // Inicia la sesión si no se ha iniciado
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruye la sesión
        session_destroy();

        // Redirige a la página de inicio (o la que desees)
        return redirect()->to(base_url('/'));
    }
}
