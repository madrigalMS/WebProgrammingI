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
  <title>Dashboard</title>
</head>
<body>
  <?php include('inc/nav.php'); ?>

  <h1>Dashboard</h1>
</body>
</html>





