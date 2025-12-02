<?php
require __DIR__ . '/../vendor/autoload.php';

use morphos\Russian;

$path = $_SERVER['REQUEST_URI'] ?? '';
$query = $_GET ?? [];

// Разрешаем только нужные пути
if (strpos($path, '/russian/names/inflect') === 0) {
    $name = $query['name'] ?? '';
    $case = $query['case'] ?? 'именительный';
    echo Russian\inflectName($name, $case);
} elseif (strpos($path, '/russian/geonames/inflect') === 0) {
    $name = $query['name'] ?? '';
    $case = $query['case'] ?? 'именительный';
    echo Russian\GeographicalNamesInflection::getCase($name, $case);
} else {
    http_response_code(404);
    echo "Endpoint not found";
}