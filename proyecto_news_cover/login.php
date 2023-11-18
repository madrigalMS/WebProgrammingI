<?php
require('utils/functions.php');

if ($_POST) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $user = authenticate($email, $password);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;

        if ($user['role_id'] === '1') {
            header('Location: admin_area/categories.php');
        } else {
            header('Location: dashboard.php');
            //header('Location: user_area/news_sources.php');
        }
    } else {
        header('Location: index.php?status=login');
    }
}
?>