<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/LR3/.core/index.php');

class UsersActions
{
    public static function signIn(): string
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return '';
        }

        if ('signIn' !== $_POST['action']) {
            return '';
        }

        $errors = UsersLogic::signIn($_POST['email'], $_POST['password']);

        $from = $_GET['from'] ?? null;

        if (empty($errors)) {
            if ($from) {
                header("Location: " . $from);
                die();
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            die();
        }

        return $errors;
    }

    public static function signUp(): array
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return [];
        }

        if ('signUp' !== $_POST['action']) {
            return [];
        }

        $errors = UsersLogic::signUp(
            $_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['fio'], $_POST['birthday'], $_POST['address'], $_POST['gender'], $_POST['interests'], $_POST['vk_profile'], $_POST['blood_type'], $_POST['Rh_factor']
        );

        if (empty($errors)) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=y");
            die();
        }

        return $errors;
    }

    public static function signOut(): void
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        if ('signOut' !== $_POST['action']) {
            return;
        }

        UsersLogic::signOut();

        header("Location: " . $_SERVER['REQUEST_URI']);
    }

    public static function requireAuth(string $from) : void
    {
        if (!UsersLogic::isAuthorized()) {
            header("Location: ../pages/login.php" . "?from=$from");
        }
    }
}