<?php

namespace LR4;

class TextWorkingLogic
{
    private static function getFirstTaskResult($text): string
    {
        preg_match_all('/<(h1|h2)[^>]*>(.*?)<\/\1>/uis', $text, $matches, PREG_SET_ORDER);

        $result = "<ol class='hnum'>";
        $h1Opened = false;
        foreach ($matches as $match) {
            $tag = $match[1];
            $text = strip_tags($match[2]);

            if ($tag == 'h1') {
                if ($h1Opened) {
                    $result .= "</ol></li>";
                }

                $result .= "<li>$text<ol>";
                $h1Opened = true;
            }
            elseif ($tag == 'h2') {
                $result .= "<li>$text</li>";
            }
        }

        if ($h1Opened) {
            $result .= "</ol></li>";
        }
        $result .= "</ol>";

        return $result;
    }

    private static function getSeventhTaskResult($text): string
    {
        $text = preg_replace('/\.{3,}/u', '…', $text);

        $text = preg_replace('/!{4,}/u', '!!!', $text);

        $text = preg_replace('/\?{4,}/u', '???', $text);

        return $text;
    }

    private static function getTwelfthTaskResult($text): string
    {
        $result = "<div class=\"table-index\">\n<h3>Указатель таблиц</h3>\n<ol>\n";

        $content = preg_replace_callback(
            '/<table\b[^>]*>.*?<tr\b[^>]*>.*?<(th|td)\b[^>]*>(.*?)<\/\1>.*?<\/table>/uis',
            function($match) use (&$result) {
                static $idx = 1;
                $id = 'table-' . $idx;

                $cellText = is_array($match[2]) ? $match[2][0] : $match[2];

                $result .= sprintf(
                    '<li><a href="#%s">Таблица %d</a> "%s"</li>'."\n",
                    $id,
                    $idx,
                    strip_tags($cellText)
                );

                $idx++;
                return preg_replace('/<table\b/i', '<table id="'.$id.'"', $match[0], 1);
            },
            $text
        );

        $result .= "</ol>\n</div>\n";
        return $result;
    }

    private static function getSeventeenthTaskResult($text): string
    {
        $text = preg_replace('/(\b\w+)((-\1\b)+)/ui', '$1<span style="background-color: yellow;">$2</span>', $text);
        return $text;
    }

    public static function getTaskResult($text, $task): string
    {
        switch ($task) {
            case 1:
                $result = self::getFirstTaskResult($text);
                break;
            case 7:
                $result = self::getSeventhTaskResult($text);
                break;
            case 12:
                $result = self::getTwelfthTaskResult($text);
                break;
            case 17:
                $result = self::getSeventeenthTaskResult($text);
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