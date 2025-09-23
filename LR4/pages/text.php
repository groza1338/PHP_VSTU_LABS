<?php
namespace LR4;
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/.core/index.php';
$text = TextWorkingActions::getTextFromForm();
$resultFirstTask = TextWorkingActions::getTaskText(1);
$resultSecondTask = TextWorkingActions::getTaskText(7);
$resultThirdTask = TextWorkingActions::getTaskText(12);
$resultFourthTask = TextWorkingActions::getTaskText(17);
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/templates/header.php';
?>
<main class="container">
    <div>
        <div class="btn-group" role="group">
            <a class="btn btn-primary" href="text.php?preset=1">
                Пресет 1
            </a>
            <a class="btn btn-primary" href="text.php?preset=2">
                Пресет 2
            </a>
            <a class="btn btn-primary" href="text.php?preset=3">
                Пресет 3
            </a>
        </div>
        <div class="btn-group" role="group">
            <a></a>
        </div>
    </div>
    <form class="m-5" method="post">
        <label for="text" class="form-label">Введите текст:</label>
        <textarea id="text" class="form-control" name="text"><?= $text ?></textarea>
        <button type="submit" class="btn btn-primary mt-2" name="action" value="submit">Отправить</button>
    </form>
    <p>
        Результаты обработки:
    </p>
    <div class="m-5">
        <p>Задание 1</p>
        <p>Найти заголовки 1-2 уровня в тексте вывести их в виде многоуровневого списка</p>
        <?= $resultFirstTask ?>
    </div>
    <div class="m-5">
        <p>Задание 7</p>
        <p>Удалить повторяющиеся знаки препинания (восклицательные и вопросительные обрезаются до трех, море точек — до многоточия).</p>
        <?= $resultSecondTask ?>
    </div>
    <div class="m-5">
        <p>Задание 12</p>
        <p>Автоматически сформировать “Указатель таблиц”. Работает как оглавление, но ссылки делаются на таблицы в документе. Текст ссылки такой: </p>
        <?= $resultThirdTask ?>
    </div>
    <div class="m-5">
        <p>Задание 17</p>
        <p>Подсветить в тексте технические повторы. Если дважды подряд вставлено одно и то же слово, второе вхождение должно быть подсвечено желтым фоном. Если слово вставлено 3, 4, более раз подряд, все вхождения после первого подсвечиваются.
            Технический повтор с примером подсветки:
            Я тучка-тучка-тучка
            Очень-очень
            Не является техническим повтором:
            Очень далеко, очень давно
        </p>
        <?= $resultFourthTask ?>
    </div>
</main>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/templates/footer.php';
?>
