<?php

function getConnection() {
  $connection = mysqli_connect('localhost', 'root','', 'proyecto_news_cover');
  return $connection;
}


function saveUser($user) {
    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `address`, `address2`, `country`, `city`, `postal_code`, `phone_number`, `role_id`) VALUES
        ('{$user['firstName']}', '{$user['lastName']}', '{$user['email']}', '{$user['password']}', '{$user['address']}', '{$user['address2']}', '{$user['country']}', '{$user['city']}', '{$user['zip']}', '{$user['phone']}', '{$user['role']}')";

    $conn = getConnection();
    mysqli_query($conn, $sql);

    return true;
}
function authenticate($email, $password){
  $conn = getConnection();
  $sql = "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$password'";
  $result = $conn->query($sql);
  if ($conn->connect_errno) {
    $conn->close();
    return false;
  }
  $results = $result->fetch_array();
  $conn->close();
  return $results;
}

function getCategories(){
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  $query = 'SELECT * from categories';
  $result = mysqli_query($connection, $query);
  $users = $result->fetch_all(MYSQLI_ASSOC);
  return $users;
}
function getNew_sources(){
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  $query = 'SELECT * from news_sources';
  $result = mysqli_query($connection, $query);
  $news_surces = $result->fetch_all(MYSQLI_ASSOC);
  return $news_surces;
}

function getCategoriesById($id){
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');

  $query = "SELECT * from categories WHERE id = $id";
  $result = mysqli_query($connection, $query);
  return $result->fetch_assoc();
}

function getNews_sources_ById($id){
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');

  $query = "SELECT * from news_sources WHERE id = $id";
  $result = mysqli_query($connection, $query);
  return $result->fetch_assoc();
}
function getNews(){
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  $query = 'SELECT * from news';
  $result = mysqli_query($connection, $query);
  $news = $result->fetch_all(MYSQLI_ASSOC);
  return $news;
}
