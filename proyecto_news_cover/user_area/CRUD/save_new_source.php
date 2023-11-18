<?php

session_start(); 

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id']; 

    $name = $_POST['name'];
    $url = $_POST['url'];
    $category_id = $_POST['category'];

    $conn = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');

    $sql = "INSERT INTO news_sources (`url`, `name`, `category_id`, `user_id`) VALUES ('$url', '$name', '$category_id', '$user_id')";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: ../news_sources.php');
        exit();
    } else {
        echo "Error al insertar registro: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
} else {
    
}