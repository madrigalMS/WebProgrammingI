<?php
require('../utils/functions.php');
require('../inc/valideSession.php');

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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
    <title>Categories</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#"><img src="../img/logo.png" class="img-fluid" width="350" height="200"></a>

            <?php include("../elements/dropdown.php"); ?>
        </div>
    </nav>

    <section class="mt-2">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-7 col-md-8 col-sm-10">
                    <div class="px-lg-5 py-lg-4 p-4">
                        <h1>Categories</h1>
                        <table class="table table-bordered">
                            <div class="mb-5 border-top">
                                <tr>
                                    <th>Category</th>
                                    <th>Action</th>

                                </tr>
                                <tbody>
                                    <?php

                                    foreach ($categories as $categorie) {
                                        echo "<tr><td>" . $categorie['name'] . "</td><td><a href=\"CRUD/edit_categorie.php?id=" . $categorie['id'] . "\">Edit</a> | <a href=\"CRUD/delete_categorie.php?id=" . $categorie['id'] . "\">Delete</a></td></tr>";
                                    }
                                    ?>
                                </tbody>
                        </table>
                        <a href="CRUD/add_categorie.php" class="btn btn-secondary w-50 mt-4 rounded-0">Add new </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <?php include("../elements/footer.php"); ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>