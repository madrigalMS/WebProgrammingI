<?php
require('../../utils/functions.php');


$news_sources = getNews_sources_ById($_REQUEST['id']);
$categories = getCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_login.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">
    <title>Hello, world!</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#"><img src="../../img/Logo.png" class="img-fluid" width="250"
                    height="200"></a>

            <?php include("../../elements/dropdown.php"); ?>
        </div>
    </nav>

    <body>
        <section>
            <div class="col-lg-5 d-flex flex-column align-items-end" style="margin-left: 100px;">
                <div class="px-lg-5 py-lg-4 p-4 w-100 align-self-center">
                    <h1 class="font-weight-bold mb-4">News Sources</h1>
                    <form method="post" action="save_edit.php">
                        <div class="mb-4 border-top">
                            <input type="hidden" value="<?php echo $news_sources['id']; ?>" name="id" />
                        </div>
                        <div class="form-group mb-3">
                            <input id="name" class="form-control" type="text" name="name"
                                value="<?php echo $news_sources['name'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input id="url" class="form-control" type="text" name="url"
                                value="<?php echo $news_sources['url'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <select id="category" class="form-control" name="category">
                                <?php
                                foreach ($categories as $category) {
                                    $id = $category['id'];
                                    $nameCategory = $category['name'];
                                    $selected = ($id == $news_sources['id_category']) ? "selected" : "";
                                    echo "<option value=\"$id\" $selected>$nameCategory</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-secondary w-50 mt-4 rounded-0"> Save </button>
                    </form>
                </div>
            </div>
        </section>
        <?php include("../../elements/footer.html"); ?>

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