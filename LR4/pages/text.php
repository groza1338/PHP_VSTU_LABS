<?php
namespace LR4;
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/.core/index.php';
$text = TextWorkingActions::getTextFromForm();
$resultFirstTask = TextWorkingActions::getFirstTaskText();
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/templates/header.php';
?>
<main class="container">
    <form class="m-5" method="post">
        <label for="text" class="form-label">Введите текст:</label>
            <textarea id="text" class="form-control" name="text"><?= $text ?></textarea>
        <button type="submit" class="btn btn-primary mt-2" name="action" value="submit">Отправить</button>
    </form>
    <div class="m-5">
        <?= $resultFirstTask ?>
    </div>
</main>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LR4/templates/footer.php';
?>
