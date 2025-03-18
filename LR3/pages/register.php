<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/.core/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/.core/UsersActions.php");
$errors = UsersActions::signUp();
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>
    <main class="container-fluid py-3">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h1 class="text-center pb-3">Регистрация</h1>
                <form class="border border-black rounded-5 shadow-lg py-5 px-5" method="post">
                    <?php
                    if (!empty($errors)) {
                        echo "<div class='mb-3 text-danger'>";
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                        echo "</div>";
                    }
                    ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               value="<?= htmlspecialchars($_POST['email'] ?? $_GET['email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password1" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword2" class="form-label">Пароль еще раз</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password2" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>ФИО
                            <input type="text" class="form-control" name="fio"
                                   value="<?= htmlspecialchars($_POST['fio'] ?? '') ?>" placeholder="Гвоздков Сергей Алексеевич" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Дата рождения
                            <input type="date" class="form-control" name="birthday"
                                   value="<?= htmlspecialchars($_POST['birthday'] ?? '') ?>" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Адрес
                            <input type="text" class="form-control" name="address"
                                   value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" placeholder="г. Волгоград, пр-кт Ленина 28" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <span>Пол</span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender"
                                   id="flexRadioDefault1" value="male" <?= empty($_POST['gender']) || $_POST['gender']==='male' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Мужской
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender"
                                   id="flexRadioDefault2" value="female" <?= isset($_POST['gender']) && $_POST['gender'] === 'female' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Женский
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Интересы
                            <textarea class="form-control" name="interests" placeholder="Пить пиво" required><?= htmlspecialchars($_POST['interests'] ?? '') ?></textarea>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Профиль ВК
                            <input type="url" class="form-control" name="vk_profile" value="<?= htmlspecialchars($_POST['vk_profile'] ?? '') ?>" placeholder="https://vk.com/s.gvozdkov" required>
                        </label>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Группа крови" name="blood_type" required>
                            <option value="">Группа крови</option>
                            <?php
                            $blood_types = ['1' => 'I', '2'=>'II', '3'=>'III', '4'=>'IV'];

                            foreach ($blood_types as $type => $name) {
                                $selected = (isset($_POST['blood_type']) && $_POST['blood_type'] == $type) ? 'selected' : '';
                                echo "<option value={$type} " . $selected .">{$name}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Резус-фактор" name="Rh_factor" required>
                            <option value="">Резус-фактор</option>
                            <?php
                            $rh_factors = ['+' => '+', '-' => '-'];
                            foreach ($rh_factors as $rh_factor => $name) {
                                $selected = (isset($_POST['Rh_factor']) && $_POST['Rh_factor']  === $rh_factor) ? 'selected' : '';
                                echo "<option value={$rh_factor} " . $selected .">{$name}</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <button type="submit" name="action" value="signUp" class="btn btn-primary">Зарегистрироваться</button>
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/footer.php");
?>