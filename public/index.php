<?php

// Подключаем автозагрузчик Composer
require __DIR__ . '/../vendor/autoload.php';

use morphos\Russian;

// Устанавливаем кодировку ответа
header('Content-Type: text/plain; charset=utf-8');

// Получаем параметры из запроса
$name = trim($_GET['name'] ?? '');
$case = trim($_GET['case'] ?? 'именительный');

// Проверка наличия имени
if ($name === '') {
    http_response_code(400);
    echo "Error: parameter 'name' is required";
    exit;
}

// Определяем тип: если содержит только одно слово — геоназвание, иначе — ФИО
if (strpos($name, ' ') === false && !preg_match('/[а-яё]/iu', $name) === false) {
    // Одно слово → считаем географическим названием
    try {
        $result = Russian\GeographicalNamesInflection::getCase($name, $case);
    } catch (Exception $e) {
        // Если не получилось — пробуем как имя
        $result = Russian\inflectName($name, $case);
    }
} else {
    // Несколько слов → ФИО
    $result = Russian\inflectName($name, $case);
}

echo $result;
