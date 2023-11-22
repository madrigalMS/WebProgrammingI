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

  <link rel="stylesheet" href="css/style.css">

  <title>Inicio de Sesión</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light px-lg-5 pt-lg-4 pb-lg-4 p-4">
    <div class="container">

      <a class="navbar-brand" href="#"><img src="img/logo.png" class="img-fluid" width="350" height="200"></a>
      <?php include("elements/dropdown.php"); ?>
    </div>
  </nav>

  <section>
    <div class="container">
      <div class="row justify-content-lg-start">
        <div class="col-lg-5 col-md-8 col-sm-10 mt-4">
          <form action="login.php" method="POST">
            <h1>User Login
            </h1>
            <div class="mb-3 mt-3 border-top">
              <label for="email" class="form-label font-weight-bold mt-4"></label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email address"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label font-weight-bold"></label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            <div class="mb-3 border-top mt-5">
            </div>
            <input type="submit" class="btn btn-secondary w-100 mt-4" value="Login">
          </form>
          <div class="text-center px-lg-5 pt-lg-3 pb-lg-4 p-4 w-100 mt-auto">
            <p class="d-inline-block mb-0">If you don't have an account</p> <a href="signup.php">Signup Here</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include("elements/footer.php"); ?>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>