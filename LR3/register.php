<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>
    <main class="container-fluid py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h1 class="text-center">Регистрация</h1>
                <form class="border border-black rounded-5 shadow-lg py-5 px-5" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               value="<?= $_GET['email'] ?? '' ?>" placeholder="serezgvozdkov@mail.ru" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword2" class="form-label">Пароль еще раз</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>ФИО
                            <input type="text" class="form-control" name="fio"
                                   value="<?= $_GET['fio'] ?? '' ?>" placeholder="Гвоздков Сергей Алексеевич" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Дата рождения
                            <input type="date" class="form-control" name="birthday"
                                   value="<?= $_GET['birthday'] ?? '' ?>" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Адрес
                            <input type="text" class="form-control" name="address"
                                   value="<?= $_GET['address'] ?? '' ?>" placeholder="г. Волгоград, пр-кт Ленина 28" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <span>Пол</span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                   id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Мужской
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                   id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Женский
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Интересы
                            <textarea class="form-control" name="interests" placeholder="Пить пиво" required><?= $_GET['interests'] ?? '' ?></textarea>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Профиль ВК
                            <input type="url" class="form-control" name="vk_profile" value="<?= $_GET['vk_profile'] ?? '' ?>" placeholder="https://vk.com/s.gvozdkov" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Группа крови" required>
                            <option selected>Группа крови</option>
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Резус-фактор" required>
                            <option selected>Резус-фактор</option>
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <button id="loginBtn" class="btn btn-secondary">Авторизация</button>
                </form>
            </div>
        </div>
    </main>

    <script>


        document.getElementById("loginBtn").addEventListener("click", function (event) {
            event.preventDefault();
            let emailValue = document.getElementById("exampleInputEmail1").value;
            if (emailValue) {
                window.location.href = "login.php?email=" + encodeURIComponent(emailValue);
            } else {
                window.location.href = "login.php" + encodeURIComponent(emailValue);
            }
        });

        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordField = document.getElementById("exampleInputPassword1");
            let passwordField1 = document.getElementById('exampleInputPassword2')
            passwordField.type = passwordField.type === "password" ? "text" : "password";
            passwordField1.type = passwordField.type;
        });

        document.getElementById("togglePassword1").addEventListener("click", function () {
            let passwordField = document.getElementById("exampleInputPassword1");
            let passwordField1 = document.getElementById('exampleInputPassword2')
            passwordField.type = passwordField.type === "password" ? "text" : "password";
            passwordField1.type = passwordField.type;
        });
    </script>

<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/footer.php");
?>