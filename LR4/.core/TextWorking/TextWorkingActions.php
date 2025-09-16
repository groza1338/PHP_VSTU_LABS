<?php
namespace LR4;
class TextWorkingActions
{
    public static function getTextFromForm() : string
    {
        $preset = $_GET['preset'] ?? null;

        if ($preset) {
            return TextWorkingLogic::getTextFromPreset($preset);
        }

        return $_POST['text'] ?? '';
    }

    public static function getFirstTaskText() : string
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return '';
        }

        if ('submit' !== $_POST['action']) {
            return '';
        }

        $text = $_POST['text'] ?? null;
        if ($text) {
            return TextWorkingLogic::getFirstTaskResult($text);
        }

        return '';
    }

}