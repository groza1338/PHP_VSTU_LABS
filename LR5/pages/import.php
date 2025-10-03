<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/index.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/files/FileActions.php');

$result = FileActions::import(); // FileLogic::import() сам возьмёт $_FILES

require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/templates/header.php');
?>

<div class="container-fluid">
    <div class="row justify-content-center my-5 mt-4">
        <div class="col col-sm-7">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="import">
                <div class="form-group">
                    <label for="uploaded_file">Импорт JSON (источник: загруженный пользователем файл)</label>
                    <input type="file"
                           class="form-control mt-1"
                           id="uploaded_file"
                           name="uploaded_file"
                           accept=".json,application/json"
                           required>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-dark hover-orange py-1">Импорт</button>
                </div>
            </form>

            <?php if (!empty($result['error'])): ?>
                <div class="alert alert-danger my-4 py-2 text-center" role="alert">
                    <p class="m-0 p-0"><?php echo htmlspecialchars($result['error'], ENT_QUOTES); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($result['data'])): ?>
                <div class="alert alert-success my-4 py-2 text-center" role="alert">
                    <p class="m-0 p-0">
                        <?php echo htmlspecialchars($result['data']['message'] ?? '', ENT_QUOTES); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/templates/footer.php'); ?>
