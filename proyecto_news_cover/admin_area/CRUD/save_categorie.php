<?php

$name = $_POST['name'];


$conn = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');


$sql = "INSERT INTO categories (`name`) VALUES ('$name')";
mysqli_query($conn, $sql);


header('location:../categories.php');