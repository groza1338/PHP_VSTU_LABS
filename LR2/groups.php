<?php
require_once "groups_logic.php";
require_once "header.php";
?>
    <div class="container-fluid" style="width: 1200px">
        <form class="text-center align-items-center justify-content-center mb-3">
            <label class="fs-5 mb-3">Фильтрация</label>
            <div class="mb-3">
                <label for="name" class="form-label">по названию:</label>
                <input type="text" id="name" name="name" placeholder="Гитара" class="form-control me-2"
                       value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="major">по направлению:</label>
                <select name="major" class="form-control" id="major">
                    <option value=""
                        <?php echo (!(isset($_GET['major'])) || $_GET['major'] === '') ? 'selected' : ''; ?>>
                        Все направления
                    </option>
                    <?php if (!empty($majors)): ?>
                        <?php foreach ($majors as $major): ?>
                            <option value="<?php echo (int)($major['id']); ?>"
                                <?php echo (isset($_GET['major']) && $_GET['major'] == $major['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($major['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                       min="<?php echo (int)($min_year) ?>" max="<?php echo (int)($max_year) ?>"
                       value="<?php echo isset($_GET['year']) ? (int)($_GET['year']) : ''; ?>">
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
            <?php if (!empty($groupItems)): ?>
                <?php foreach ($groupItems as $row): ?>
                    <tr>
                        <th scope="row">
                            <img src="/LR2/group_photos/<?php echo htmlspecialchars($row['group_photo']); ?>"
                                 style="max-width: 200px;" alt="фото группы">
                        </th>
                        <td class="fw-light"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['majors_name']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['FIO_group']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['year_of_entry']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Нет данных</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Останавливаем стандартную отправку формы

                const formData = new FormData(form);
                const params = new URLSearchParams();

                formData.forEach((value, key) => {
                    if (value.trim() !== "") { // Добавляем только НЕ пустые параметры
                        params.append(key, value);
                    }
                });

                const queryString = params.toString();
                const actionUrl = form.getAttribute("action");

                // Перенаправляем без пустых параметров
                window.location.href = queryString ? `${actionUrl}?${queryString}` : actionUrl;
            });
        });
    </script>

<?php
require_once "footer.php";
?>