<?php


function getConnection() {
  $connection = mysqli_connect('localhost', 'root','', 'php_web2');
  return $connection;
}

function getProvincesBD() {
  $conn = getConnection();
  $sql = "SELECT * FROM `provinces`;";

  $result = mysqli_query($conn, $sql);
  $provinces = $result->fetch_all(MYSQLI_ASSOC);
  
  return $provinces;
}

function saveUser($user){
  $sql = "INSERT INTO `users` (`firtsname`, `lastname`, `email`, `province_id`, `password`, `role`, `image_url`, `status`, `last_login_datetime`) VALUES
      ('{$user['firstName']}', '{$user['lastName']}', '{$user['email']}', '{$user['province_id']}',
      '{$user['password']}', '{$user['role']}', '{$user['profilePic']}', 'active', NULL);";

  $conn = getConnection();
  mysqli_query($conn, $sql);

  return true;
}

function getUsers(){
  $connection = mysqli_connect('localhost', 'root', '', 'php_web2');

  $query = 'SELECT * from users';
  $result = mysqli_query($connection, $query);
  $users = $result->fetch_all(MYSQLI_ASSOC);
  return $users;
}

function getUserById($id){
  $connection = mysqli_connect('localhost', 'root', '', 'php_web2');

  $query = "SELECT * from users WHERE id = $id";
  $result = mysqli_query($connection, $query);
  return $result->fetch_assoc();
}

function updateLastLoginDatetime($userId) {
  date_default_timezone_set('America/Mexico_City');
  $current_datetime = date("Y-m-d H:i:s");
  $sql = "UPDATE users SET last_login_datetime = '$current_datetime' WHERE id = $userId";
  
  $conn = getConnection();
  mysqli_query($conn, $sql);
}