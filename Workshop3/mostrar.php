<?php
 require('utils/functions.php');

$users = getUsers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Usuarios</h1>
            <p class="lead">Listado de Usuarios</p>
            <hr class="my-4">
        </div>

        <a href="/nuevo_usuario.php">Nuevo</a>
        <table class="table table-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Province</th>
                <th>Password</th>
                <th>Action</th>
        
            </tr>
            <tbody>
                <?php
                
                foreach ($users as $user) {
                    echo "<tr><td>" . $user['firtsname'] . "</td><td>" . $user['lastname'] . "</td><td>" . $user['email'] . "</td><td>" . $user['province_id'] . "</td><td>" . $user['password'] . "</td><td><a href=\"editar.php?id=" . $user['id'] . "\">Edit</a> | <a href=\"eliminar.php?id=".$user['id']."\">Delete</a></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>