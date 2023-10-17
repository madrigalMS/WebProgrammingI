
<?php

$temperatures = [78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];

// Calcula la temperatura promedio
$average = array_sum($temperatures) / count($temperatures);

// Elimina duplicados y ordenar el array de temperaturas
$uniqueTemperatures = array_unique($temperatures);
sort($uniqueTemperatures);

// Obtiene las 5 temperaturas más bajas
$lowestTemperatures = array_slice($uniqueTemperatures, 0, 5);

// Obtiene las 5 temperaturas más altas
$highestTemperatures = array_slice($uniqueTemperatures, -5);

echo "Average Temperature is: " . number_format($average, 1) . "\n\n";
echo "List of 5 lowest temperatures (no duplicates): " . implode(", ", $lowestTemperatures) . "\n\n";
echo "List of 5 highest temperatures (no duplicates): " . implode(", ", $highestTemperatures) . "\n";
?>