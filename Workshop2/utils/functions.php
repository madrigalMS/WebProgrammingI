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

  $firstName = $user['firstName'];
$lastName = $user['lastName'];
$email = $user['email']; 
$province = $user['province_id'];
$password = $user['password']; 

$sql = "INSERT INTO users (firstname, lastname, email, province, password) VALUES ('$firstName', '$lastName', '$email', '$province', '$password')";

  $conn = getConnection() ;
  mysqli_query($conn, $sql);
  return true;
}