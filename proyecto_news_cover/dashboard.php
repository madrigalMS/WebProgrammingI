<?php
require('utils/functions.php');


session_start(); 

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id']; 
} else {
    
}

$noticias = getNews();
$categories = getCategories();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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

            <a class="navbar-brand" href="#"><img src="img/logo.png" class="img-fluid" width="250" height="200"></a>

            <?php include("elements/dropdown.php"); ?>
        </div>
    </nav>

    <section class="text-center container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-3 mx-auto">
                <h1 class="fw-light mb-4" style="letter-spacing: 1px;">Your unique News Cover</h1>
            </div>
        </div>
    </section>


    <section>
        <div class="container mt-5 mb-2">
            <div class="row justify-content-center">
                <?php foreach ($categories as $categorie): ?>
                    <div class="col-lg-2 col-md-4 mb-3">
                        <div class="category-container border">
                            <a href="dashboard.php?category_id=<?php echo $categorie['id']; ?>"
                                class="btn btn-block w-100 h-100 text-decoration-none">
                                <?php echo $categorie['name']; ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    

    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($noticias as $noticia): ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo $noticia['image_url']; ?>" alt="News Image"
                                class="bd-placeholder-img card-img-top" width="100%" height="225">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $noticia['title']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $noticia['short_description']; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?php echo $noticia['permanlink']; ?>"
                                            class="btn btn-sm text-info btn-outline-secondary">Ver Noticia</a>
                                    </div>
                                    <small class="text-muted">
                                        <?php echo $noticia['date']; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </section>


    <?php include("elements/footer.html"); ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>