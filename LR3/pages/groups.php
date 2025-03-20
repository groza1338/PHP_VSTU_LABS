<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/.core/index.php');
GroupsActions::clearFilters();
UsersActions::requireAuth();
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
            <input type="submit" name="clearFilter" value="Очистить фильтр" class="btn btn-danger">
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
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("form_groups")
            console.log("aboba");
            console.log(form);

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Останавливаем стандартную отправку формы

                const formData = new FormData(form);
                console.log(formData)
                const params = new URLSearchParams();
                console.log(params)

                formData.forEach((value, key) => {
                    if (value.trim() !== "") { // Добавляем только НЕ пустые параметры
                        params.append(key, value);
                    }
                });
                console.log(params);
                const queryString = params.toString();
                console.log(queryString);
                const actionUrl = form.action;
                console.log(actionUrl);

                // Перенаправляем без пустых параметров
                window.location.href = queryString ? `${actionUrl}?${queryString}` : actionUrl;
            });
        });
    </script>

<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/templates/footer.php');
?>