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
            } elseif ($tag == 'h2') {
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

    private static function getTwelfthTaskResult(string &$text): string
    {
        $re = '~(?P<open><table\b[^>]*>)\s*'
            . '.*?<tr\b[^>]*>\s*'
            . '.*?<(?P<celltag>th|td)\b[^>]*>(?P<cell>.*?)</(?P=celltag)>'
            . '.*?</table>~uis';

        $result = "<div class=\"table-index\">\n<h3>Указатель таблиц</h3>\n<ol>\n";

        $text = preg_replace_callback(
            $re,
            static function (array $m) use (&$result) {
                static $idx = 1;

                $open = $m['open'];

                if (preg_match('~\bid\s*=\s*([\'"])([^\'"]+)\1~i', $open, $idMatch)) {
                    $id = $idMatch[2];
                    $newOpen = $open;
                } else {
                    $id = 'table-' . $idx;
                    $newOpen = preg_replace('~<table\b~i', '<table id="' . $id . '"', $open, 1);
                }

                $label = trim(preg_replace('/\s+/u', ' ', strip_tags($m['cell'])));
                $label = htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                $result .= sprintf(
                    "<li><a href=\"#%s\">Таблица %d “%s”</a></li>\n",
                    $id,
                    $idx,
                    $label
                );

                $idx++;

                return $newOpen . substr($m[0], strlen($open));
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