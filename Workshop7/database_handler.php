User
<?php
class DatabaseHandler
{
    private $db;

    public function __construct()
    {
    

    }
    public static function saveUser($userData, $files)
    {
        // Verifica si se proporciona un arreglo con los datos del usuario
        if (is_array($userData)) {
            $db = mysqli_connect('localhost', 'root', '', 'php_web2');
            $firstName = $userData['firstName'];
            $lastName = $userData['lastName'];
            $email = $userData['email'];
            $provinceId = $userData['province'];
            $password = $userData['password'];
            $role = $userData['role'];

            // Verifica si se cargó un archivo
            $profilePic = '';
            if (isset($files["profilePic"])) {
                $file_tmp = $files["profilePic"]["tmp_name"];
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($files["profilePic"]["name"]);

                // Mueve el archivo cargado a la ubicación deseada
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $profilePic = $target_file; // Guarda la ruta de la imagen en el arreglo del usuario
                }
            }

            // Realiza la inserción en la base de datos
            $sql = "INSERT INTO `users` (`firtsname`, `lastname`, `email`, `province_id`, `password`, `role`, `image_url`, `status`, `last_login_datetime`) VALUES
                ('$firstName', '$lastName', '$email', '$provinceId', '$password', '$role', '$profilePic', 'active', NULL);";

            mysqli_query($db, $sql);

            return true;
        } else {
            return false; // No se proporcionaron datos válidos
        }
    }

    public static function saveOrUpdateUser($userData) {
        $conn = mysqli_connect('localhost', 'root', '', 'php_web2');
        $firstName = $userData['firstName'];
        $lastName = $userData['lastName'];
        $email = $userData['email'];
        $provinceId = $userData['province'];
        $password = $userData['password'];
        $role = $userData['role'];
    
        // Verifica si se está realizando una actualización (update)
        if (isset($userData['id'])) {
            $sql = "UPDATE users SET `firtsname` = '$firstName', `lastname` = '$lastName', `email` = '$email', `province_id` = $provinceId, `password` = '$password', `role` = '$role'
                    WHERE `id` = {$userData['id']} ";
        } else {
            $sql = "INSERT INTO users (`firtsname`, `lastname`, `email`, `province_id`, `password`, `role`)
                    VALUES ('$firstName', '$lastName', '$email', $provinceId, '$password', '$role')";
        }
    
        mysqli_query($conn, $sql);
        header('location: mostrar.php');
    }
    public static function deleteUser($userId) {
        $conn = mysqli_connect('localhost', 'root', '', 'php_web2');
    
        $sql = "DELETE FROM users WHERE `id` = $userId";
        mysqli_query($conn, $sql);
    }

    function authenticate($username, $password){
        $conn = getConnection();
        $sql = "SELECT * FROM users WHERE `firtsname` = '$username' AND `password` = '$password' AND `status` = 'active'";
        $result = $conn->query($sql);
        if ($conn->connect_errno) {
          $conn->close();
          return false;
        }
        $results = $result->fetch_array();
        $conn->close();
        return $results;
      }

}