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

function authenticate($username, $password){
  $conn = getConnection();
  $sql = "SELECT * FROM users WHERE `firtsname` = '$username' AND `password` = '$password'";
  $result = $conn->query($sql);
  if ($conn->connect_errno) {
    $conn->close();
    return false;
  }
  $results = $result->fetch_array();
  $conn->close();
  return $results;
}

function saveUser($user){

$sql = "INSERT INTO `users` (`firtsname`, `lastname`, `email`, `province_id`, `password`, `role`) VALUES
    ('{$user['firstName']}', '{$user['lastName']}', '{$user['email']}', '{$user['province_id']}', 
    '{$user['password']}', '{$user['role']}');";
    
  $conn = getConnection() ;
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