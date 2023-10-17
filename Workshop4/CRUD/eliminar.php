<?php

$id = $_REQUEST['id'];

if($id) {

  $sql = "DELETE FROM users WHERE `id` = $id";
  $conn = mysqli_connect('localhost', 'root', '', 'php_web2');
  mysqli_query($conn, $sql);
}

header('location: mostrar.php');