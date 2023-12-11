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
    <title>Add Categorie</title>
</head>

<body>
    <?= $dropdown ?>

    <section class="mt-4">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-5 col-md-8 col-sm-10 mt-5">
                    <form method="post" action="<?= site_url('categorie/save_edit') ?>">
                        <h1 class="mb-4">Categories</h1>
                        <hr class="mb-5 my-4"> <!-- Línea horizontal -->
                        <div class="mb-3">
                            <input type="hidden" value="<?= $categorie['id']; ?>" name="id" />
                            <div class="form-group mb-3">
                                <input id="name" class="form-control" type="text" name="name"
                                    value="<?= $categorie['name'] ?>">
                            </div>
                        </div>
                        <hr class="mt-5 mb-5"> <!-- Línea horizontal -->
                        <button type="submit" class="btn btn-secondary w-50 mt-4 rounded-0"> Save </button>
                    </form>
                </div>
                <div class="mt-5"></div>
            </div>
        </div>
        <div class="mt-5"></div>
    </section>
    <div class="mt-5"></div>

    <?php include("elements/footer.php"); ?>

    <!-- Agrega tus scripts JS y otros elementos aquí -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>