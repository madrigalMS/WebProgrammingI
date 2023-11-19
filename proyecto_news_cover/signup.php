<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style_login.css">
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style_login.css">
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
  <title>Hello, world!</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="img/Logo.png" class="img-fluid" width="250" height="200"></a>
      <?php include("elements/dropdown.php"); ?>
    </div>
  </nav>

  <section>
    <div class="col-lg-5 d-flex flex-column align-items-end" style="margin-left: 100px;">
      <form method="post" action="save_user.php">
        <div class="form-row">
          <h1 class="mb-4">User Registration</h1>
          <div class="form-group col-md-12 border-top"></div>
          <div class="form-group col-md-6">
            <input type="text" name="firstName" class="form-control" id="inputFirstName4" placeholder="First Name">
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="lastName" class="form-control" id="inputLastName4" placeholder="Last Name">
          </div>
          <div class="form-group col-md-6">
            <input type="email" name="email" class="form-control" id="inputEmailAddress4" placeholder="Email Address">
          </div>
          <div class="form-group col-md-6">
            <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Address">
        </div>
        <div class="form-group">
          <input type="text" name="address2" class="form-control" id="inputAddress2" placeholder="Address 2">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <select class="form-select" name="country" id="country">
              <option value="" disabled selected>Select Country</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Mexico">Mexico</option>
              <option value="United States">United States</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="city" class="form-control" id="inputCity" placeholder="City">
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="zip" class="form-control" id="inputZip" placeholder="Zip/Postal Code">
          </div>
          <div class="form-group col-md-6">
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number">
          </div>
          <div class="form-group">
            <input type="hidden" name="role" value="2" />
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
      </form>
    </div>
  </section>
  <?php include("elements/footer.html"); ?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+Jc