<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css/style_login.css">
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;600&display=swap" rel="stylesheet">

<?php

$isLoggedIn = isset($_SESSION['user']);
$isAdmin = $isLoggedIn && $_SESSION['user']['role_id'] === '1';
$isUser = $isLoggedIn && $_SESSION['user']['role_id'] !== '1';
?>

<div class="dropdown d-flex justify-content-end">
    <?php if ($isLoggedIn): ?>
        <button class="btn btn-secondary d-flex align-items-center p-3 rounded-0" type="button" id="loginDropdownButton"
            data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($isAdmin): ?>
                <i class="fas fa-user me-2"></i> Admin
            <?php elseif ($isUser): ?>
                <i class="fas fa-user me-2"></i>
                <?php echo $_SESSION['user']['first_name']; ?>
            <?php endif; ?>
        </button>
        <div class="dropdown-menu">
            <?php if ($isAdmin): ?>
                <a class="dropdown-item" href='/WebProgrammingI/proyecto_news_cover/admin_area/categories.php'>Categories</a>
            <?php elseif ($isUser): ?>
                <a class="dropdown-item" href="/WebProgrammingI/proyecto_news_cover/user_area/news_sources.php">News Sources</a>
                <a class="dropdown-item" href="/WebProgrammingI/proyecto_news_cover/dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a class="dropdown-item" href="/WebProgrammingI/proyecto_news_cover/logout.php">Logout</a>
        </div>
    <?php else: ?>
        <a href="index.php" class="btn btn-secondary d-flex align-items-center p-3 rounded-0">
            <i class="fas fa-user me-2"></i> Login
        </a>
    <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pzjw8f+ua/C5K0H8g9Ru8szQ4S1fp6wkg3G5Hj8Fg0PkIi4qFqF/PQ2tcXgOkI5L"
    crossorigin="anonymous"></script>