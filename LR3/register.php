<?php
require_once 'register_logic.php';
require_once 'header.php';
?>
    <main class="container-fluid py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h1 class="text-center">Регистрация</h1>
                <form class="border border-black rounded-5 shadow-lg py-5 px-5" action="login_logic.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= $_GET['email'] ?? '' ?>" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                👁️
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="exampleInputPassword2" class="form-label">Пароль</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                👁️
                            </button>
                        </div>
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
            window.location.href = "login.php?email=" + encodeURIComponent(emailValue);
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
require_once 'footer.php';
?>