<?php

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$provinceId = $_POST['province'];
$password = $_POST['password'];
$role = $_POST['role'];

// Verifica si se está realizando una actualización (update)
if (isset($_POST['id'])) {
  $sql = "UPDATE users SET `firtsname` = '$firstName', `lastname` = '$lastName', `email` = '$email', `province_id` = $provinceId, `password` = '$password', `role` = '$role'
          WHERE `id` = {$_POST['id']} ";
} else {
  $sql = "INSERT INTO users (`firtsname`, `lastname`, `email`, `province_id`, `password`, `role`)
          VALUES ('$firstName', '$lastName', '$email', $provinceId, '$password', '$role')";
}

$conn = mysqli_connect('localhost', 'root', '', 'php_web2');
mysqli_query($conn, $sql);

header('location: mostrar.php'); // Redirige a la página de usuarios después de guardar o actualizar.