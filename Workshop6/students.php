<?php
require 'utils/functions.php';

if (count($argv) !== 2) {
    echo "Uso: php students.php X\n";
    exit(1);
}

$numRecords = intval($argv[1]);

if ($numRecords <= 0) {
    echo "X debe ser un número positivo.\n";
    exit(1);
}

$students = getStudents();

for ($i = 0; $i < $numRecords && $i < count($students); $i++) {
    $student = $students[$i];
    echo "{$student->getId()}, {$student->getName()}, {$student->getLastname()}, {$student->getCedula()}, {$student->getAge()}\n";
}
?>