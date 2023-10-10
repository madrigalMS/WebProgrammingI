<?php
  session_start();
  $user = $_SESSION['user'];

  if (!$user) {
    header('Location: index.php');
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users List</title>
</head>
<body>

  <?php include('inc/nav.php'); ?>

  <h1>Users </h1>

  <table class="table">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">Bladimir</td>
        <td>Arroyo</td>
        <td><a href="">Edit</a> | <a href="">Delete</a> </td>
      </tr>
      <tr>
        <td scope="row">Bladimir</td>
        <td>Arroyo</td>
        <td><a href="/users/edit.php?id=1">Edit</a> | <a href="/users/delete.php?id=1">Delete</a> </td>
      </tr>

    </tbody>
  </table>
</body>
</html>





