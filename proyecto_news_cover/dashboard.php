<?php
require('utils/functions.php');
require('inc/valideSession.php');

$user_id = $user['id'];

if (!userHasNewsSources($user_id)) {
    // Si no tiene fuentes de noticias, redirígelo a la página para agregar fuentes
    header('Location: user_area/CRUD/add_new_source.php');
    exit();
}
if (!userHasNews($user_id)) {
    // Si no tiene noticias, muestra un mensaje indicando que no hay noticias actualizadas
    echo '<script>';
    echo 'alert("Aún no se han actualizado las noticias.");';
    echo 'window.location.href = "user_area/CRUD/add_new_source.php";'; // Puedes ajustar la URL según tus necesidades
    echo '</script>';
    exit;
    // Puedes incluir aquí un formulario o enlace para que el usuario actualice las noticias
} else {
    $allNews = getAllNews($user_id);

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

                <a class="navbar-brand" href="#"><img src="img/Logo.png" class="img-fluid" width="250" height="200"></a>

                <?php include("elements/dropdown.php"); ?>
            </div>
        </nav>

        <section class="text-center container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-3 mx-auto">
                    <h1 class="fw-light mb-4" style="letter-spacing: 1px;">Your unique News Cover</h1>
                    <div class="col-lg-4 mb-3 border-top mt-4 mx-auto"></div>
                </div>
            </div>
        </section>

        <?php
        $userCategoriesNews = getUserCategoriesNews($user_id);
        $userCategoryIds = array_column($userCategoriesNews, 'category_id');
        $categories = getCategoriesByIds($userCategoryIds);

        // Verifica si se ha pasado un ID de usuario (por ejemplo, desde "Portada")
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            // Obtén todas las noticias para el usuario
            $allNews = getAllNews($user_id);

            // Puedes usar $allNews para mostrar todas las noticias
        } elseif (isset($_GET['category_id'])) {
            $selectedCategoryId = $_GET['category_id'];

            // Obtén las noticias asociadas a la categoría seleccionada
            $newsForSelectedCategory = getNewsByCategoryId($selectedCategoryId, $user_id);


        }
        ?>
        <section>
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <!-- Agregar un enlace para la "portada" y las categorías en la misma línea -->
                    <div class="col-lg-2 col-md-4 mb-3">
                        <div class="category-container border">
                            <a href="dashboard.php?user_id=<?php echo $user['id']; ?>"
                                class="btn btn-block w-100 h-100 text-decoration-none">
                                Portada
                            </a>
                        </div>
                    </div>

                    <?php foreach ($categories as $category): ?>
                        <div class="col-lg-2 col-md-4 mb-3">
                            <div class="category-container border">
                                <a href="dashboard.php?category_id=<?php echo $category['id']; ?>"
                                    class="btn btn-block w-100 h-100 text-decoration-none">
                                    <?php echo $category['name']; ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="album py-5">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?php

                        $newsToShow = isset($newsForSelectedCategory) ? $newsForSelectedCategory : $allNews;

                        foreach ($newsToShow as $noticia):
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="card shadow-sm d-flex flex-column h-100">
                                    <img src="<?php echo $noticia['image_url']; ?>" alt="News Image"
                                        class="bd-placeholder-img card-img-top" width="100%" height="225">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-end mb-2">
                                            <small class="text-muted">
                                                <?php echo $noticia['category_name']; ?>
                                            </small>
                                        </div>
                                        <h5 class="card-title">
                                            <?php echo $noticia['title']; ?>
                                        </h5>
                                        <p class="card-text flex-grow-1">
                                            <?php echo substr($noticia['short_description'], 0, 200); ?>
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

            <?php include("elements/footer.html"); ?>

            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

    </body>

    </html>
    <?php
}
?>