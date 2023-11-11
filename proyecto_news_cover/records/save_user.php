<?php
require('utils/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstName'])) {
  $user = array(
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'address' => $_POST['address'],
    'address2' => $_POST['address2'],
    'country' => $_POST['country'],
    'city' => $_POST['city'],
    'zip' => $_POST['zip'],
    'phone' => $_POST['phone'],
    'role' => $_POST['role']
  );

  if (saveUser($user)) {
    header('Location: index.php');
  } else {
    header('Location: /?error=true');
  }
}
?>