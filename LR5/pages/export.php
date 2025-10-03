<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/index.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/files/FileActions.php');

$result = FileActions::export();

require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/templates/header.php');
?>

<div class="container-fluid">
    <div class="row justify-content-center my-5 mt-4">
        <div class="col col-sm-7">
            <form method="POST">
                <input type="hidden" name="action" value="export">
                <div class="form-group">
                    <label for="path_to_save">Название XML файла</label>
                    <input type="text" class="form-control mt-1" id="path_to_save" name="path_to_save" placeholder="export.xml" required
                           value="<?php echo $_POST['path_to_save'] ?? null ?>">
                </div>
                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-dark hover-orange py-1">Сохранить</button>
                </div>
            </form>
            <?php if (!empty($result['error'])): ?>
                <div class="alert alert-danger my-4 py-2 text-center" role="alert">
                    <p class="m-0 p-0"><?php echo $result['error'] ?></p>
                </div>
            <?php endif; ?>
            <?php if (!empty($result['data'])): ?>
                <div class="alert alert-success my-4 py-2 text-center" role="alert">
                    <p class="m-0 p-0">
                        <?php echo htmlspecialchars($result['data']['message'] ?? '', ENT_QUOTES); ?>
                    </p>
                    <a class="m-0 p-0" <?php echo $result['data']['anchor_attributes']; ?>>Скачать файл</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/templates/footer.php');
?>
