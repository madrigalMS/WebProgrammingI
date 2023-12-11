<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model { // Fix the capitalization here
    protected $table = 'users';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'address', 'address2', 'country', 'city', 'postal_code', 'phone_number', 'role_id'];

    public function authenticate($email, $password)
    {
        // Utiliza el helper de CodeIgniter para proteger contra inyecciones SQL
        $email = esc($email);
        $password = esc($password);

        // Realiza la consulta utilizando el builder de CodeIgniter
        $user = $this->where(['email' => $email, 'password' => $password])->first();

        // Verifica si se encontró un usuario
        return $user ? $user : false;
    }

    public function saveUser($user)
    {
        $this->insert($user);
        return true;
    }
}
?>