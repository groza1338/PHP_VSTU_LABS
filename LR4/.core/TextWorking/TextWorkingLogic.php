<?php

namespace LR4;

class TextWorkingLogic
{
    public static function getFirstTaskResult($text) : string
    {
        // Регулярные выражения для поиска заголовков 1 и 2 уровня
        $patternH1 = '/<h1[^>]*>(.*?)<\/h1>/is';  // Используем флаг 's' для захвата символов новой строки
        $patternH2 = '/<h2[^>]*>(.*?)<\/h2>/is';  // Используем флаг 's' для захвата символов новой строки

        // Массивы для хранения заголовков
        $h1_headers = [];
        $h2_headers = [];

        // Находим все заголовки <h1>
        preg_match_all($patternH1, $text, $h1_headers);

        // Находим все заголовки <h2>
        preg_match_all($patternH2, $text, $h2_headers);

        foreach ($h1_headers[1] as $h1_header) {
            $h1_header = trim($h1_header);
            echo htmlspecialchars($h1_header);
        }

        // Начинаем строить HTML список
        $html = "<ol>";  // Здесь используем <ol> для нумерованного списка

        // Преобразуем найденные заголовки <h1> в список
        foreach ($h1_headers[1] as $index => $h1) {
            $html .= "<li>" . trim($h1);  // Заголовок первого уровня
            $html .= "<ol>";  // Начинаем вложенный список для <h2>

            // Преобразуем заголовки <h2>, относящиеся к этому <h1>
            $h2Index = 1;
            foreach ($h2_headers[1] as $h2) {
                if ($h2Index <= $index + 1) {  // Это условие фильтрует <h2>, относящиеся к текущему <h1>
                    $html .= "<li>" . trim($h2) . "</li>";
                }
                $h2Index++;
            }

            $html .= "</ol></li>";  // Закрываем вложенный список
        }

        $html .= "</ol>";  // Закрываем основной список

        return $html;
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