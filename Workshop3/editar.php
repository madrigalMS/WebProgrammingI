<?php
 require('utils/functions.php');

$users = getUsers(); 
$user = getUserById($_REQUEST['id']); 
$provinces = getProvincesBD();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Usuarios</h1>
            <p class="lead">Editar usuario</p>
            <hr class="my-4">
        </div>
        <form method="post" action="guardar.php">
            <input type="hidden" value="<?php echo $user['id']; ?>" name="id" />
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input id="first-name" class="form-control" type="text" name="firstName"
                    value="<?php echo $user['firtsname'] ?>">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input id="last-name" class="form-control" type="text" name="lastName"
                    value="<?php echo $user['lastname'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" class="form-control" type="text" name="email"
                    value="<?php echo $user['email'] ?>">
            </div>
            <div class="form-group">
                <label for="province">Province</label>
                <select id="province" class="form-control" name="province">
                    <?php
                    foreach ($provinces as $province) {
                        if ($user['province_id'] == $province['id']) {
                            echo "<option selected value=\"" . $province['id'] . "\">" . $province['province'] . "</option>";
                        } else {
                            echo "<option value=\"" . $province['id'] . "\">" . $province['province'] . "</option>";
                        }
                    }
                    ?>
             </select>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password"
                    value="<?php echo $user['password'] ?>">
            </div>
            <div class="form-group">
            <input type="hidden" name="role" value="user" />
            </div>
            <button type="submit" class="btn btn-primary"> Guardar </button>
    </form>
  </div>

</body>

</html>