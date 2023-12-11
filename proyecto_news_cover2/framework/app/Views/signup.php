<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">

    <title>User Registration</title>
</head>

<body>

    <?= $dropdown ?>

    <section class="mt-4">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-5 col-md-8 col-sm-10 mt-4">
                    <form method="post" action="signup/register">
                        <h1>User Registration</h1>
                        <hr class="my-4"> <!-- Línea horizontal -->
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <input type="text" name="firstName" class="form-control" placeholder="First Name"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="text" name="lastName" class="form-control" placeholder="Last Name"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="address2" class="form-control" placeholder="Address 2">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <select id="country" class="form-select" name="country" required>
                                    <?php
                                    echo '<option value="" disabled selected>Select Country</option>';
                                    foreach ($countriesArray as $country) {
                                        echo "<option value=\"$country\">$country</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="text" name="city" class="form-control" placeholder="City" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <input type="text" name="zip" class="form-control" placeholder="Zip/Postal Code"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <input type="hidden" name="role" value="2" />
                        <hr class="my-4"> <!-- Línea horizontal -->
                        <button type="submit" class="btn btn-secondary">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("elements/footer.php"); ?>

    <!-- Bootstrap Bundle (Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>