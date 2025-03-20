<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR3/.core/index.php');
UsersActions::signOut();
$currentUser = UsersLogic::currentUser();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/LR3/bootstrap/bootstrap.css">
    <title>Новая школа</title>
    <link rel="icon" href="/LR3/public/-_1.ico" type="image/x-icon"/>
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container-fluid">
        <div class="d-flex flex-nowrap align-items-center justify-content-center justify-content-lg-start">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-auto">
                <img src="/LR3/public/logo.svg" alt="лого" class="img-fluid" style="height: 40px;">
            </a>

            <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 me-auto">
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ШКОЛА</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ОБУЧЕНИЕ</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ДЕТЯМ</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ВЗРОСЛЫМ</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ПРЕПОДАВАТЕЛЯМ</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">МАГАЗИН</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">КРУЖКИ ДЛЯ ВСЕХ</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">ЛЕТНИЕ КАНИКУЛЫ</a></li>
            </ul>

            <div class="dropdown text-end">
                <?php if (!empty($currentUser)): ?>
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://picsum.photos/32" alt="profile_img" width="32" height="32"
                             class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <li>
                            <div class="dropdown-item-text">
                                <?=$currentUser['email']?>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-item-text">
                                <?=$currentUser['FIO']?>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Настройки</a></li>
                        <li><a class="dropdown-item" href="#">Профиль</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST">
                                <button type="submit" class="dropdown-item text-danger">Выйти</button>
                                <input type="hidden" name="action" value="signOut">
                            </form>
                    </ul>
                <?php else: ?>
                    <a type="button" href="../pages/login.php" class="btn btn-primary me-2">Войти</a>
                    <a type="button" href="../pages/register.php" class="btn btn-warning">Зарегистрироваться</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>