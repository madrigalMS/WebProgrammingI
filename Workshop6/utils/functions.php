<?php
require 'students/student.php';

function getConnection() {
  $connection = mysqli_connect('localhost', 'root', '', 'php_web2');
  return $connection;
}

function getStudents() {
    $conn = getConnection();
    $query = "SELECT * FROM students";
    $result = mysqli_query($conn, $query);

    $students = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student = new Student($row['id'], $row['name'], $row['lastname'], $row['cedula'], $row['age']);
            $students[] = $student;
        }
    }

    return $students;
}
?>