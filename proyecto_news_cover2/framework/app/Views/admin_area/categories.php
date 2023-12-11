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
    <title>Categories</title>
</head>

<body>
    
    <?= $dropdown ?>

    <section class="mt-2">
        <div class="container">
            <div class="row justify-content-lg-start">
                <div class="col-lg-7 col-md-8 col-sm-10">
                    <div class="px-lg-5 py-lg-4 p-4">
                        <h1>Categories</h1>
                        <table class="table table-bordered">
                            <div class="mb-5 border-top">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td>
                                                <?= $category['name'] ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('categorie_edit/' . $category['id']) ?>">Edit</a> |
                                                <a href="<?= site_url('categorie_delete/' . $category['id']) ?>"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                        </table>
                        <a href="<?= site_url('categorie_add') ?>" class="btn btn-secondary w-50 mt-4 rounded-0">Add
                            new</a>
                    </div>
                </div>
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