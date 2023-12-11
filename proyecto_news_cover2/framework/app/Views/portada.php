<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <title>Portada</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#"><img src="/img/logo.png" class="img-fluid" width="300" height="200"></a>
        </div>
    </nav>

    <section class="text-center container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-3 mx-auto mt-5">
                <h2>Portada</h2>
                <div class="col-lg-4 mb-3 border-top mt-4 mx-auto"></div>
            </div>
        </div>
    </section>

    <!-- Muestra el card con las noticias -->
    <div class="album py-5 ">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php

                foreach ($allNews as $noticia):
                    ?>
                    <div class="col-md-4">
                            <div class="card shadow-sm d-flex flex-column h-100">
                                <?php
                                // Verifica si la imagen se puede cargar
                                $imageSource = $noticia['image_url'];
                                $defaultImage = '/img/news.png';

                                echo '<img src="' . esc($imageSource) . '" alt="News Image" class="bd-placeholder-img card-img-top" width="100%" height="225" onerror="this.src=\'' . esc($defaultImage) . '\';">';
                                ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-end mb-2">
                                        <small class="text-muted">
                                            <?php echo esc($noticia['category_name']); ?>
                                        </small>
                                    </div>
                                    <h5 class="card-title">
                                        <?php echo esc($noticia['title']); ?>
                                    </h5>
                                    <p class="card-text flex-grow-1">
                                        <?php echo esc(substr($noticia['short_description'], 0, 200)); ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="<?php echo esc($noticia['permanlink']); ?>"
                                                class="btn btn-sm text-info btn-outline-secondary">Ver Noticia</a>
                                        </div>
                                        <small class="text-muted">
                                            <?php echo esc($noticia['date']); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php include("elements/footer.php"); ?>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

</body>

</html>