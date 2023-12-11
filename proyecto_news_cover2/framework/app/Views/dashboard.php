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
    <title>Dashboard</title>
</head>

<body>

    <?= $dropdown ?>

    <section class="text-center container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-3 mx-auto mt-5">
                <h2>Your unique News Cover</h2>
                <div class="col-lg-4 mb-3 border-top mt-4 mx-auto"></div>
            </div>
        </div>
    </section>

    <!-- Script JavaScript para cambiar la visibilidad -->
    <script>
        function link() {
            // Obtén el contenedor de la URL
            var urlContainer = document.getElementById('urlContainer');

            // Cambia la visibilidad del contenedor
            if (urlContainer.style.display === 'none' || urlContainer.style.display === '') {
                urlContainer.style.display = 'block';
            } else {
                urlContainer.style.display = 'none';
            }
        }
    </script>

    <div class="container mt-3">
        <!-- Botón "Publicar mi Portada" -->
        <button class="btn btn-secondary rounded-0" onclick="link()">Publicar portada</button>
        <!-- Muestra la URL en un div (inicialmente oculto) -->
        <div id="urlContainer" style="display: none;">
            <input type="text" value="<?php echo esc($portadaURL); ?>" readonly class="form-control border-0 bg-white">
        </div>
    </div>


    <div class="container mt-3">
        <div class="row justify-content-center">
            <form action="<?= site_url('dashboard'); ?>" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Palabra clave" name="keyword">
                    <button class="btn btn-secondary rounded-0 " type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <section>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <!-- Muestra la portada -->
                <div class="col-lg-2 col-md-4 mb-3">
                    <div class="category-container border">
                        <a href="<?= site_url("dashboard?user_id={$user_id}"); ?>"
                            class="btn btn-block border-1 border-secondary w-100 h-100 text-decoration-none">
                            Portada
                        </a>
                    </div>
                </div>

                <!-- Muestra las categorias-->
                <?php foreach ($categories as $category): ?>
                    <div class="col-lg-2 col-md-4 mb-3">
                        <div class="category-container border">
                            <a href="<?= site_url("selectCategory/{$category['id']}"); ?>"
                                class="btn btn-block border-1 border-secondary w-100 h-100 text-decoration-none">
                                <?= esc($category['name']); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sección de etiquetas con checkboxes -->
        <div class="container mt-3">
            <div class="row justify-content-center">
                <form action="<?= site_url('dashboard'); ?>" method="post">
                    <div class="form-group">
                        <label for="tags">Selecciona etiquetas:</label>
                        <select name="tags[]" id="tags" class="form-control mt-3" multiple>
                            <?php if (isset($etiquetasPorCategoria)): ?>
                                <?php foreach ($etiquetasPorCategoria as $etiqueta): ?>
                                    <option value="<?= $etiqueta ?>">
                                        <?= $etiqueta ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary border-0 mt-3 rounded-0">Filtrar</button>
                </form>
            </div>
        </div>

        <!-- Muestra el card con las noticias -->
        <div class="album py-5">
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