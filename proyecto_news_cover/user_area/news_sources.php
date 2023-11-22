<?php
require('../utils/functions.php');
require('../inc/valideSession.php');

$user_id = $user['id'];
$categories = getCategories();
$news_sources = getUserNews_sources($user_id);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/style.css">
  <title>News Sources</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">

      <a class="navbar-brand" href="#"><img src="../img/logo.png" class="img-fluid" width="350" height="200"></a>
      <?php include("../elements/dropdown.php"); ?>
    </div>
  </nav>

  <section class="mt-2">
    <div class="container mt-4">
      <div class="row justify-content-lg-start">
        <div class="col-lg-7 col-md-8 col-sm-10">
          <div class="px-lg-5 py-lg-4 p-4">
            <h1>News Sources</h1>
            <div class="border-top">
              <table class="mt-5 table table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($news_sources as $new) {
                    echo "<tr><td>" . $new['name'] . "</td><td>" . $new['category_name'] . "</td><td><a href=\"CRUD/edit_new_source.php?id=" . $new['id'] . "\">Edit</a> | <a href=\"CRUD/delete_new_source.php?id=" . $new['id'] . "\">Delete</a></td></tr>";
                  }
                  ?>
                </tbody>
              </table>
              <a href="CRUD/add_new_source.php" class="btn btn-secondary w-50 mt-5 rounded-0">Add new</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("../elements/footer.php"); ?>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>