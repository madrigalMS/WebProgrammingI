<?php
require('utils/functions.php');

if ($_POST) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $user = authenticate($username, $password);

    if ($user) {
        // Iniciar sesión
        session_start();
        $_SESSION['user'] = $user;

        // Actualizar last_login_datetime en la base de datos
        updateLastLoginDatetime($user['id']);

        // Redirigir al panel de control
        header('Location: dashboard.php');
    } else {
        header('Location: index.php?status=login');
    }
}


?>