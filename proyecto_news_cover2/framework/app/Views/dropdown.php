<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css/style_login.css">
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light px-lg-5 pt-lg-4 pb-lg-4 p-4">
    <div class="container">

        <a class="navbar-brand" href="#"><img src="/img/logo.png" class="img-fluid" width="350" height="200"></a>

        <?php
        $isLoggedIn = isset($user);
        $isAdmin = $isLoggedIn && $role === '1';
        $isUser = $isLoggedIn && $role !== '1';
        ?>

        <div class="dropdown d-flex justify-content-end">
            <?php if ($isLoggedIn): ?>
                <button class="btn btn-secondary d-flex align-items-center p-3 rounded-0" type="button"
                    id="loginDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if ($isAdmin): ?>
                        <i class="fas fa-user me-2"></i> Admin
                    <?php elseif ($isUser): ?>
                        <i class="fas fa-user me-2"></i>
                        <?php echo $firstname; ?>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu">
                    <?php if ($isAdmin): ?>
                        <a class="dropdown-item" href="<?= site_url('categories'); ?>">Categories</a>
                        <a class="dropdown-item" href="<?= site_url('admin/logout'); ?>">Logout</a>
                    <?php elseif ($isUser): ?>
                        <a class="dropdown-item" href="<?= site_url('news_sources'); ?>">News Sources</a>
                        <a class="dropdown-item" href="<?= site_url('dashboard'); ?>">Dashboard</a>
                        <a class="dropdown-item" href="<?= site_url('user/logout'); ?>">Logout</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a href="<?= site_url('/'); ?>" class="btn btn-secondary d-flex align-items-center p-3 rounded-0">
                    <i class="fas fa-user me-2"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pzjw8f+ua/C5K0H8g9Ru8szQ4S1fp6wkg3G5Hj8Fg0PkIi4qFqF/PQ2tcXgOkI5L"
    crossorigin="anonymous"></script>