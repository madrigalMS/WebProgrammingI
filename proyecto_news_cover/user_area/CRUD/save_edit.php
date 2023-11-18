<?php

$name = $_POST['name'];
$url = $_POST['url'];
$category = $_POST['category'];

// Verifica si se está realizando una actualización (update)
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE news_sources SET `name` = '$name', `url` = '$url', `category_id` = '$category' WHERE `id` = $id";
} else {
    $sql = "INSERT INTO news_sources (`name`, `url`, `category_id`) VALUES ('$name', '$url', '$category')";
}

$conn = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
mysqli_query($conn, $sql);

header('location:../news_sources.php');
?>