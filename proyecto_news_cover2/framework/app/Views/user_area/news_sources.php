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
    <title>News Sources</title>
</head>

<body>

    <?= $dropdown ?>

    <section class="mt-2">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-7 col-md-8 col-sm-10">
                    <div class="px-lg-5 py-lg-4 p-4">
                        <h1>News Sources</h1>
                        <table class="table table-bordered">
                            <div class="mb-5 border-top mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($news_sources as $new): ?>
                                        <tr>
                                            <td>
                                                <?= $new['name'] ?>
                                            </td>
                                            <td>
                                                <?= $new['category_name'] ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url("news_sources_edit/{$new['id']}") ?>">Edit</a> |
                                                <a href="<?= site_url("news_sources_delete/{$new['id']}") ?>"
                                                    onclick="return confirm('Are you sure you want to delete this new_source?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                        </table>
                        <hr class="my-4 mt-5"> <!-- Línea horizontal -->
                        <a href="<?= site_url('news_source/add') ?>" class="btn btn-secondary w-50 mt-4 rounded-0">Add
                            new</a>
                    </div>
                </div>
            </div>
            <div class="mt-5"></div>
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