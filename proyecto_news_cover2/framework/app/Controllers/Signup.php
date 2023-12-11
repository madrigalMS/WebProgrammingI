<?php

namespace App\Controllers;

use App\Models\user;


class Signup extends BaseController
{
    private $countriesArray;
    protected $session;

    public function __construct()
    {
        $this->countriesArray = ["Afganistán", "Albania", "Alemania", "Andorra", "Angola", "Antigua y Barbuda", "Arabia Saudita", "Argelia", "Argentina", "Armenia", "Australia", "Austria", "Azerbaiyán", "Bahamas", "Bangladés", "Barbados", "Baréin", "Bélgica", "Belice", "Benín", "Bielorrusia", "Birmania", "Bolivia", "Bosnia y Herzegovina", "Botsuana", "Brasil", "Brunéi", "Bulgaria", "Burkina Faso", "Burundi", "Bután", "Cabo Verde", "Camboya", "Camerún", "Canadá", "Catar", "Chad", "Chile", "China", "Chipre", "Ciudad del Vaticano", "Colombia", "Comoras", "Corea del Norte", "Corea del Sur", "Costa de Marfil", "Costa Rica", "Croacia", "Cuba", "Dinamarca", "Dominica", "Ecuador", "Egipto", "El Salvador", "Emiratos Árabes Unidos", "Eritrea", "Eslovaquia", "Eslovenia", "España", "Estados Unidos", "Estonia", "Etiopía", "Filipinas", "Finlandia", "Fiyi", "Francia", "Gabón", "Gambia", "Georgia", "Ghana", "Granada", "Grecia", "Guatemala", "Guyana", "Guinea", "Guinea ecuatorial", "Guinea-Bisáu", "Haití", "Honduras", "Hungría", "India", "Indonesia", "Irak", "Irán", "Irlanda", "Islandia", "Islas Marshall", "Islas Salomón", "Israel", "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kirguistán", "Kiribati", "Kuwait", "Laos", "Lesoto", "Letonia", "Líbano", "Liberia", "Libia", "Liechtenstein", "Lituania", "Luxemburgo", "Madagascar", "Malasia", "Malaui", "Maldivas", "Malí", "Malta", "Marruecos", "Mauricio", "Mauritania", "México", "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montenegro", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Níger", "Nigeria", "Noruega", "Nueva Zelanda", "Omán", "Países Bajos", "Pakistán", "Palaos", "Palestina", "Panamá", "Papúa Nueva Guinea", "Paraguay", "Perú", "Polonia", "Portugal", "Reino Unido", "República Centroafricana", "República Checa", "República de Macedonia", "República del Congo", "República Democrática del Congo", "República Dominicana", "República Sudafricana", "Ruanda", "Rumanía", "Rusia", "Samoa", "San Cristóbal y Nieves", "San Marino", "San Vicente y las Granadinas", "Santa Lucía", "Santo Tomé y Príncipe", "Senegal", "Serbia", "Seychelles", "Sierra Leona", "Singapur", "Siria", "Somalia", "Sri Lanka", "Suazilandia", "Sudán", "Sudán del Sur", "Suecia", "Suiza", "Surinam", "Tailandia", "Tanzania", "Tayikistán", "Timor Oriental", "Togo", "Tonga", "Trinidad y Tobago", "Túnez", "Turkmenistán", "Turquía", "Tuvalu", "Ucrania", "Uganda", "Uruguay", "Uzbekistán", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Yibuti", "Zambia", "Zimbabue"];
        $this->session = session();
    }
    public function index()
    {
        $user = $this->session->get('user');
        $data['user'] = $user;
        $data['countriesArray'] = $this->countriesArray;
        $data['dropdown'] = view('dropdown');

        return view('signup', $data);
    }
    public function register()
    {
        $user = [
            'first_name' => $this->request->getPost('firstName'),
            'last_name' => $this->request->getPost('lastName'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'address' => $this->request->getPost('address'),
            'address2' => $this->request->getPost('address2'),
            'country' => $this->request->getPost('country'),
            'city' => $this->request->getPost('city'),
            'postal_code' => $this->request->getPost('zip'),
            'phone_number' => $this->request->getPost('phone'),
            'role_id' => $this->request->getPost('role'),
        ];

        $model = new User();
        $model->saveUser($user);

        // Email 
        $asunto = "Validación";
        $msg = "Registro exitoso " . $user['first_name'];
        $header = "From: proyectomynewscover@gmail.com" . "\r\n";
        $header .= "Reply-To: proyectomynewscover@gmail.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();

        $mail = mail($user['email'], $asunto, $msg, $header);

        return redirect()->to('/');
    }
}
?>