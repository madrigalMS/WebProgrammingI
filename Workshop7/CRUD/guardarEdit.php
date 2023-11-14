<?php

require_once('../database_handler.php');

$userData = $_POST;

databaseHandler::saveOrUpdateUser($userData);
