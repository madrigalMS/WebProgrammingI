<?php
  session_start();
  $user = $_SESSION['user'];

  if (!$user) {
    header('Location: index.php');
  }
  ?>