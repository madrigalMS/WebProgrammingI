<?php

require('database_handler.php'); 

$userData = $_POST; // Suponiendo que los datos del usuario provienen de $_POST

if (databaseHandler::saveUser($userData, $_FILES)) {
    header('Location: index.php');
} else {
    header("Location: /?error=true");
}
?>