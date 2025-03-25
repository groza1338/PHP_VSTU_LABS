<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/.core/index.php');
UsersActions::requireAuth($_SERVER['SCRIPT_NAME']);
GroupsActions::getMajorsOptions();
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>
    <div class="container-fluid" style="width: 1200px">
        <form method="get" class="text-center align-items-center justify-content-center mb-3" id="form_groups">
            <label class="fs-5 mb-3">Фильтрация</label>
            <div class="mb-3">
                <label for="name" class="form-label">по названию:</label>
                <input type="text" id="name" name="name" placeholder="Гитара" class="form-control me-2"
                       value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="major">по направлению:</label>
                <select name="major" class="form-control" id="major">
                    <?= GroupsActions::getMajorsOptions() ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fio" class="form-label">по фио:</label>
                <input type="text" id="fio" name="fio" placeholder="Федоров Павел Сергеевич" class="form-control me-2"
                       value="<?php echo isset($_GET['fio']) ? htmlspecialchars($_GET['fio']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">по году:</label>
                <input type="number" id="year" name="year" placeholder="2024" class="form-control me-2"
                       value="<?php echo isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''; ?>">
            </div>
            <input type="submit" value="Применить фильтр" class="btn btn-primary me-2">
            <a class="btn btn-danger" href="groups.php">Очистить фильтр</a>
        </form>
        <table class="table table-bordered">
            <thead>
            <tr class="table-light">
                <th scope="col" class="fw-medium">Изображение</th>
                <th scope="col" class="fw-medium">Название</th>
                <th scope="col" class="fw-medium">Направление</th>
                <th scope="col" class="fw-medium">ФИО Группы</th>
                <th scope="col" class="fw-medium">Год поступления</th>
            </tr>
            </thead>
            <tbody>
                <?=GroupsActions::getGroupsItemsTable() ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("form_groups").addEventListener("submit", function(event) {
            let form = event.target;
            let submitter = event.submitter; // Узнаем, какая кнопка отправила форму

            // Если нажата кнопка очистки фильтров — не изменяем параметры
            if (submitter && submitter.name === "clearFilter") {
                return;
            }

            event.preventDefault(); // Останавливаем стандартную отправку формы

            let formData = new FormData(form);
            let params = new URLSearchParams();

            // Убираем пустые поля из запроса
            for (let [key, value] of formData.entries()) {
                if (value.trim() !== "") {
                    params.append(key, value);
                }
            }

            // Перенаправляем на тот же URL, но без пустых параметров
            let actionUrl = form.getAttribute("action") || window.location.pathname;
            if (params.toString()) {
                window.location.href = actionUrl + "?" + params.toString();
            } else {
                window.location.href = actionUrl
            }

        });
    </script>

<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/templates/footer.php');
?>