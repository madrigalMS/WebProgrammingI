<?php

function getConnection()
{
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  return $connection;
}


// Guarda un usuario nuevo
function saveUser($user)
{
  $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `address`, `address2`, `country`, `city`, `postal_code`, `phone_number`, `role_id`) VALUES
        ('{$user['firstName']}', '{$user['lastName']}', '{$user['email']}', '{$user['password']}', '{$user['address']}', '{$user['address2']}', '{$user['country']}', '{$user['city']}', '{$user['zip']}', '{$user['phone']}', '{$user['role']}')";

  $conn = getConnection();
  mysqli_query($conn, $sql);

  return true;
}

function authenticate($email, $password)
{
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

// Obtiene todos los registros de la tabla categorias
function getCategories()
{
  $conn = getConnection();
  $query = 'SELECT * from categories';
  $result = mysqli_query($conn, $query);
  $users = $result->fetch_all(MYSQLI_ASSOC);
  return $users;
}

// Obtiene todos los registros de la tabla news_sources
function getNew_sources()
{
  $conn = getConnection();
  $query = 'SELECT * from news_sources';
  $result = mysqli_query($conn, $query);
  $news_surces = $result->fetch_all(MYSQLI_ASSOC);
  return $news_surces;
}

function getCategoriesById($id)
{
  $conn = getConnection();

  $query = "SELECT * from categories WHERE id = $id";
  $result = mysqli_query($conn, $query);
  return $result->fetch_assoc();
}

 // Obtiene los registro de la tabla news_sources según el id
function getNews_sources_ById($id)
{
  $conn = getConnection();

  $query = "SELECT * from news_sources WHERE id = $id";
  $result = mysqli_query($conn, $query);
  return $result->fetch_assoc();
}

 // Obtiene el id y nombre de las categorias de la tabla news_soruces
function getUserNews_sources($user_id)
{
  $conn = getConnection();
  $query = "SELECT DISTINCT ns.id AS id, ns.category_id, c.name AS category_name, ns.name AS name
              FROM news_sources ns
              INNER JOIN categories c ON ns.category_id = c.id
              WHERE ns.user_id = ?";

  $statement = $conn->prepare($query);
  $statement->bind_param("i", $user_id);
  $statement->execute();
  $result = $statement->get_result();

  $categories = $result->fetch_all(MYSQLI_ASSOC);

  $statement->close();

  return $categories;
}

function getNews()
{
  $connection = mysqli_connect('localhost', 'root', '', 'proyecto_news_cover');
  $query = 'SELECT * from news';
  $result = mysqli_query($connection, $query);
  $news = $result->fetch_all(MYSQLI_ASSOC);
  return $news;
}

 // Obtiene todas las noticias del usuario según su cateogoria
function getUserCategoriesNews($user_id)
{
  $conn = getConnection();
  $query = "SELECT DISTINCT category_id FROM news WHERE user_id = ?";
  $statement = $conn->prepare($query);
  $statement->bind_param("i", $user_id);
  $statement->execute();
  $result = $statement->get_result();


  $categories = $result->fetch_all(MYSQLI_ASSOC);

  $statement->close();

  return $categories;
}

 // Obtiene el nombre de las categorias según un arreglo de ids
function getCategoriesByIds($category_ids)
{
  $conn = getConnection();
  $inClause = implode(',', array_fill(0, count($category_ids), '?'));

  $query = "SELECT DISTINCT id, name FROM categories WHERE id IN ($inClause)";
  $statement = $conn->prepare($query);

  $types = str_repeat('i', count($category_ids));
  $statement->bind_param($types, ...$category_ids);

  $statement->execute();
  $result = $statement->get_result();

  $categories = $result->fetch_all(MYSQLI_ASSOC);

  $statement->close();

  return $categories;
}

 // Obtiene el nombre de las categorias según un arreglo de ids
function getNewsByCategoryId($categoryId, $user_id)
{
  $conn = getConnection();
  $query = "SELECT news.*, categories.name AS category_name 
            FROM news 
            INNER JOIN categories ON news.category_id = categories.id
            WHERE news.category_id = $categoryId AND news.user_id = $user_id 
            ORDER BY news.date DESC";

  $result = mysqli_query($conn, $query);

  if ($result) {
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $news;
  } else {
    die("Error al obtener noticias: " . mysqli_error($conn));
  }
}

 // Obtiene todas las notcias de un usuario según su id
function getAllNews($user_id)
{
  $conn = getConnection();
  $query = "SELECT news.*, categories.name AS category_name 
            FROM news 
            INNER JOIN categories ON news.category_id = categories.id
            WHERE news.user_id = ? 
            ORDER BY news.date DESC";

  $statement = $conn->prepare($query);
  $statement->bind_param("i", $user_id);
  $statement->execute();
  $result = $statement->get_result();

  if ($result) {
    $news = $result->fetch_all(MYSQLI_ASSOC);
    $statement->close();
    return $news;
  } else {
    die("Error retrieving all news with category names: " . $conn->error);
  }
}

 // Verifica si el usuario tiene noticias
function userHasNewsSources($user_id)
{
  $conn = getConnection();
  $query = "SELECT COUNT(*) as count FROM news_sources WHERE user_id = $user_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
  } else {
    die("Error al verificar si el usuario tiene noticias: " . mysqli_error($conn));
  }
}

 // Obtiene el nombre de las categorias según un arreglo de ids
function userHasNews($user_id)
{
  $conn = getConnection();
  $query = "SELECT COUNT(*) as count FROM news WHERE user_id = $user_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
  } else {
    die("Error al verificar si el usuario tiene noticias: " . mysqli_error($conn));
  }
}
