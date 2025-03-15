<?php

class UserAction
{
    public static function signIn(): string
    {
        // TODO: Дописать
        return '';
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
            header("Location " . $_SERVER['PHP_SELF'] . "?success=y");
            die();
        }

        return $errors;
    }
}