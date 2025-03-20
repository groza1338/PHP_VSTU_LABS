<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/LR3/.core/index.php');
// Проверяем авторизацию
if (!UsersLogic::isAuthorized()) {
    http_response_code(403);
    exit("Доступ запрещен: Вы не авторизованы.");
}

// Директория с изображениями
$imageDir = $_SERVER['DOCUMENT_ROOT'] . "/LR3/group_photos/";

// Получаем имя файла из GET-запроса
$file = basename($_GET['file'] ?? '');
$filePath = $imageDir . $file;

// Проверяем, существует ли файл
if (!file_exists($filePath)) {
    http_response_code(404);
    exit("Файл не найден.");
}

// Определяем MIME-тип файла
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $filePath);
finfo_close($finfo);

// Отдаем заголовки и содержимое файла
header("Content-Type: $mimeType");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit();
