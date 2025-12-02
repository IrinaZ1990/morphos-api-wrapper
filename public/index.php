<?php
require __DIR__ . '/../vendor/autoload.php';
use morphos\Russian;

header('Content-Type: text/plain; charset=utf-8');

$name = $_GET['name'] ?? '';
$case = $_GET['case'] ?? 'именительный';

if (!$name) {
    http_response_code(400);
    echo "Error: missing 'name' parameter";
    exit;
}

echo Russian\inflectName($name, $case);
