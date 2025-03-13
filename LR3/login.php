<?php
require_once 'login_logic.php';
require_once 'header.php';
?>
<main class="container-fluid py-5">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <h1 class="text-center">Вход в систему</h1>
            <form class="border border-black rounded-5 shadow-lg py-5 px-5" action="login_logic.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
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
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("exampleInputPassword1");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });
</script>

<?php
require_once 'footer.php';
?>