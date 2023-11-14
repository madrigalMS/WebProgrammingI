<?php
if ($argc != 2) {
    die("Uso: php validateActiveSessions.php <horas>\n");
}

$dbh = getConnection();

$hours = intval($argv[1]);
$current_datetime = date("Y-m-d H:i:s");
$inactive_datetime = date("Y-m-d H:i:s", strtotime("-$hours hours", strtotime($current_datetime)));


$query = "UPDATE users SET status = 'inactive' WHERE status = 'active' AND last_login_datetime <= ?";
$stmt = $dbh->prepare($query);
$stmt->bind_param('s', $inactive_datetime);
$stmt->execute();


$dbh->close();

echo "Usuarios marcados como inactivos.\n";

function getConnection() {
    $connection = new mysqli('localhost', 'root', '', 'php_web2');
    
    if ($connection->connect_error) {
        die("Error: " . $connection->connect_error);
    }
    
    return $connection;
}