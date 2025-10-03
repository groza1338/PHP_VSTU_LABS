<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/index.php');

if (!UsersLogic::isAuthorized()) {
    http_response_code(403);
    exit("Доступ запрещен: Вы не авторизованы.");
}

$imageDir = $_SERVER['DOCUMENT_ROOT'] . "/LR5/group_photos/";

$file = basename($_GET['file'] ?? '');
$filePath = $imageDir . $file;

if (!file_exists($filePath)) {
    http_response_code(404);
    exit("Файл не найден.");
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $filePath);
finfo_close($finfo);

header("Content-Type: $mimeType");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit();
