<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/files/FileLogic.php');

class FileActions
{
    public static function import() : ?array
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD'] || 'import' !== $_POST['action']) {
            return null;
        }

        return FileLogic::import($_POST['url_to_file'] ?? null);
    }

    public static function export() : ?array
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD'] || 'export' !== $_POST['action']) {
            return null;
        }

        return FileLogic::export($_POST['path_to_save'] ?? null);
    }
}