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

    <section class="mt-3">
        <div class="container mb-3">
            <div class="row justify-content-lg-start">
                <div class="col-lg-5 col-md-8 col-sm-10 mt-5">
                    <form action="<?= site_url('categorie/add') ?>" method="POST">
                        <h1 class="mb-4">Categories</h1>
                        <div class="mb-4 border-top">
                            <label for="name" class="form-label font-weight-bold mt-5"></label>
                            <input type="name" name="name" class="form-control" placeholder="Name"
                                aria-describedby="nameHelp">
                        </div>
                        <div class="mb-3 border-top mt-5"></div>
                        <input type="submit" class="btn btn-secondary w-100 mt-4" value="Save">
                        <div class="mt-5"></div>
                    </form>
                    <div class="mt-5"></div>
                </div>
            </div>
            <div class="mt-5"></div>
        </div>
    </section>

    <?php include("elements/footer.php"); ?>

    <!-- Agrega tus scripts JS y otros elementos aquí -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>