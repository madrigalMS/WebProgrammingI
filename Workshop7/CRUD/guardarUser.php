<?php

require('database_handler.php'); 

$userData = $_POST; 

if (databaseHandler::saveUser($userData, $_FILES)) {
    header('Location: mostrar.php');
} else {
    header("Location: /?error=true");
}
?>

 