<?php
$connection = mysqli_connect('localhost', 'root', '', 'php_web2');


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users"; 

$result = mysqli_query($connection, $sql); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body> 
    <h2>Usuarios</h2>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Province</th>
            <th>Password</th>
        </tr>

        <?php
        while ($mostrar = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['firstname'] ?></td>
                <td><?php echo $mostrar['lastname'] ?></td>
                <td><?php echo $mostrar['email'] ?></td>
                <td><?php echo $mostrar['province'] ?></td>
                <td><?php echo $mostrar['password'] ?></td>
            </tr>
        <?php
        }
        mysqli_close($connection); 
        ?>
    </table>
</body>
</html>