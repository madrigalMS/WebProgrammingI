<?php
require('../../utils/functions.php');
$categories = getCategories();
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
    <link rel="stylesheet" href='../css/style_login.css'>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <title>Hello, world!</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#"><img src='../../img/Logo.png' class="img-fluid" width="250" height="200"></a>

            <?php include("../../elements/dropdown.php"); ?>
        </div>
    </nav>

    <section>
        <div class="col-lg-5 d-flex flex-column align-items-end" style="margin-left: 100px;">
            <div class="px-lg-5 py-lg-4 p-4 w-100 alingn-self-center">
                <h1 class="mb-4">News Source</h1>
                <form action="save_new_source.php" method="POST" class="form-inline" role="form">
                    <div class="mb-3 border-top">
                        <label for="InputName" class="form-label font-weight-bold mt-4"></label>
                        <input type="name"  name="name" class="form-control" placeholder="Name" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                        <input type="url" name="url" class="form-control" placeholder="RSS URL">
                    </div>
                    <div class="mb-3">
                        <select id="category" class="form-control" name="category">
                        
                            <?php
                            foreach ($categories as $category) {
                                $id = $category['id'];
                                $nameCategory = $category['name'];
                                echo "<option value=\"$id\">$nameCategory</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 border-top mt-5">
                    </div>
                    <button type="submit" class="btn btn-secondary w-100 mt-4">Save</button>
                </form>
            </div>
        </div>
    </section>
    <?php include('../../elements/footer.html'); ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>