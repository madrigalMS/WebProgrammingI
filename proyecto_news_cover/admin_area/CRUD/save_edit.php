<?php

$name = $_POST['name'];


// Verifica si se está realizando una actualización (update)
if (isset($_POST['id'])) {
  $sql = "UPDATE categories SET `name` = '$name' 
          WHERE `id` = {$_POST['id']} ";
} else {
  $sql = "INSERT INTO categories (`name`)
          VALUES ('$firstName')";
}

$conn = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
mysqli_query($conn, $sql);

header('location:../categories.php'); 