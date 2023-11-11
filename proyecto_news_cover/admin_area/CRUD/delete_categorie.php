<?php

$id = $_REQUEST['id'];

if($id) {

  $sql = "DELETE FROM categories WHERE `id` = $id";
  $conn = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  mysqli_query($conn, $sql);
}

header('location:../categories.php');