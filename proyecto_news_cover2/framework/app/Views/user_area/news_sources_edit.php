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

    <link rel="stylesheet" href="/css/style.css">
    <title>Edit News Source</title>
</head>

<body>

    <?= $dropdown ?>

    <section class="mt-2">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-5 col-md-8 col-sm-10 mt-5">
                    <form method="post" action="<?= site_url('news_source/save_edit') ?>">
                        <h1 class="font-weight-bold mb-4">News Sources</h1>
                        <div class="mb-4 border-top">
                            <input type="hidden" value="<?php echo $news_sources['id']; ?>" name="id" />
                        </div>
                        <div class="form-group mb-3 mt-5">
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
                                    $selected = ($id == $news_sources['category_id']) ? "selected" : "";
                                    echo "<option value=\"$id\" $selected>$nameCategory</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <hr class="my-4 mt-5"> <!-- Línea horizontal -->
                        <button type="submit" class="btn btn-secondary w-50 mt-4 rounded-0">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("elements/footer.php"); ?>
    <!-- Agrega tus scripts JS y otros elementos aquí -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>