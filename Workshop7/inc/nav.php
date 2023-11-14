<nav class="nav">
    <span> Bienvenido <?php echo $user['firtsname'] . ' ' . $user['lastname']; ?> </span>
    <?php if (!empty($user['image_url'])): ?>
        <div class="d-flex flex-column align-items-center">
            <img src="<?php echo $user['image_url']; ?>" alt="User Image" class="img-fluid rounded-circle" style="max-width: 50px; max-height: 50px;">
        </div>
    <?php endif; ?>
    <li class="nav-item">
    <a href="logout.php">Logout</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="/dashboard.php" tabindex="-1" aria-disabled="true">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Arboles</a>
    </li>
    <?php if ($user['role'] === 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link active" href="CRUD/mostrar.php">Users</a>
        </li>
    <?php endif; ?>
</nav>