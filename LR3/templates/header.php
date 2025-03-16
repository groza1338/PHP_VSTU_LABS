<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/.core/index.php');
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
<header class="border-bottom border-black">
    <nav class="navbar">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">
                <img src="/LR3/public/logo.svg" alt="лого" class="img-fluid" style="height: 40px;">
            </a>

            <!-- Левая часть -->
            <ul class="navbar-nav d-flex flex-row align-items-center me-auto gap-3">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        ШКОЛА
                    </a>
                    <ul class="dropdown-menu overflow-auto" style="max-height: 10rem">
                        <li>
                            <a class="dropdown-item" href="#">О нас</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Фонд "Дар"</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Команда</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Новости</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Поступление</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Стоимость обучения и стипендии</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Работа в школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Продюсерский центр</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">СМИ о нас</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Экскурсия по школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Отчёты</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Сведения об образовательной организации</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Контакты</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">ЭЛЖУР</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        ОБУЧЕНИЕ
                    </a>
                    <ul class="dropdown-menu overflow-auto" style="max-height: 10rem">
                        <li>
                            <a class="dropdown-item" href="#">Поступление</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Стоимость обучения и стипендии</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Подростковая школа 5-8 классы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Старшая школа 9-11 классы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Вторая смена</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Заочка</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Успехи новошкольников</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Проектная деятельность</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        ДЕТЯМ
                    </a>
                    <ul class="dropdown-menu overflow-auto" style="max-height: 10rem">
                        <li>
                            <a class="dropdown-item" href="#">Поступление</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Зимняя школа</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Кружки для всех</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Каникулы в Новой школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Семейные программы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Заочка</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Вторая смена</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Старшая школа Микс</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Профориентационные экскурсии</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Дошкольное отделение</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Тьюторские консультации</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Видео курсов</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">День рождения в школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Магазин</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Подарочный сертификат</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">ВЗРОСЛЫМ</a>
                    <ul class="dropdown-menu overflow-auto" style="max-height: 10rem">
                        <li>
                            <a class="dropdown-item" href="#">Работа в школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Курсы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Семейные программы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Видео курсов</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Образовательные экскурсии по школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Аренда помещений</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Магазин</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Подарочный сертификат</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">ПРЕПОДАВАТЕЛЯМ</a>
                    <ul class="dropdown-menu overflow-auto" style="max-height: 10rem">
                        <li>
                            <a class="dropdown-item" href="#">Работа в школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Курсы</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Стажировки для тьюторов</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Видео курсов</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Образовательные экскурсии по школе</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Аренда помещений</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Магазин</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Подарочный сертификат</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">МАГАЗИН</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">КРУЖКИ ДЛЯ ВСЕХ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ЛЕТНИЕ КАНИКУЛЫ</a>
                </li>
                <?php if (empty($currentUser)): ?>
                    <div class="d-flex flex-column align-items-end">
                        <span>Вы не авторизованы</span>
                        <div class="d-flex">
                            <a class="text-orange hover-darkorange" href="<?='../pages/login.php'?>">Ввести логин и пароль</a>
                            <span class="mx-1">или</span>
                            <a class="text-orange hover-darkorange" href="<?='../pages/register.php'?>">зарегистрироваться</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex align-items-center gap-2">
                        <span>Вы авторизованы как <span class="text-orange"><?php echo $currentUser['email'] ?></span></span>
                        <form method="post" style="display:inline;">
                            <button type="submit" name="action" value="signOut" class="btn btn-dark hover-orange py-1" style="font-size: 14px;">
                                Выйти
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>