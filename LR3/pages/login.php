<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/LR3/.core/index.php');
$error = UsersActions::signIn();
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>
<main class="container-fluid py-3">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <h1 class="text-center pb-3">Вход в систему</h1>
            <form class="border border-black rounded-5 shadow-lg py-5 px-5" method="post">
                <?php
                if (!empty($error)) {
                    echo "<div class='mb-3 text-danger'>";
                    echo $error;
                    echo "</div>";
                }
                ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $_GET['email'] ?? '') ?>" required>
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
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="action" value="signIn">Войти</button>
                    <div class="d-flex align-items-center">
                        <label class="me-2">Нет аккаунта?</label>
                        <a id="registerBtn" href="#" class="link-dark link-opacity-75-hover link-underline-opacity-75-hover">
                            Зарегистрируйтесь
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById("registerBtn").addEventListener("click", function (event) {
        event.preventDefault();
        let emailValue = document.getElementById("exampleInputEmail1").value;
        if (emailValue) {
            window.location.href = "register.php?email=" + encodeURIComponent(emailValue);
        } else {
            window.location.href = "register.php" + encodeURIComponent(emailValue);
        }
    });

    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("exampleInputPassword1");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });
</script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/footer.php");
?>