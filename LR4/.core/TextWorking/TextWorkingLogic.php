<?php

namespace LR4;

class TextWorkingLogic
{
    private static function getFirstTaskResult($text): string
    {
        return '1';
    }

    private static function getSecondTaskResult($text): string
    {
        return '2';
    }

    private static function getThirdTaskResult($text): string
    {
        return '3';
    }

    private static function getFourthTaskResult($text): string
    {
        return '4';
    }

    public static function getTaskResult($text, $task): string
    {
        switch ($task) {
            case 1:
                $result = self::getFirstTaskResult($text);
                break;
            case 2:
                $result = self::getSecondTaskResult($text);
                break;
            case 3:
                $result = self::getThirdTaskResult($text);
                break;
            case 4:
                $result = self::getFourthTaskResult($text);
                break;
            default:
                return '';
        }
        return $result;
    }


    public static function getTextFromPreset(?int $preset): string
    {
        $htmlDir = $_SERVER['DOCUMENT_ROOT'] . "/LR4/.core/TextWorking/htmlFiles/";

        $filepath = $htmlDir . $preset . ".html";

        if (file_exists($filepath)) {
            return file_get_contents($filepath);
        }

        return "";
    }

}