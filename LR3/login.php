<?php
require_once 'login_logic.php';
require_once 'header.php';
?>
    <main class="container-fluid py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form class="border border-black rounded-5 shadow-lg py-5 px-5" action="login_logic.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Проверить меня</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </main>
<?php
require_once 'footer.php';
?>