<?php

require_once('../database_handler.php');

$userIDToDelete = $_REQUEST['id'] ?? null;

if ($userIDToDelete) {
    databaseHandler::deleteUser($userIDToDelete);
}

header('location: mostrar.php');