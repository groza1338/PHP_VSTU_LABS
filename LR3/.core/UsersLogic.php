<?php

class UsersLogic
{
    public static function signUp(
        string $email, string $password, string $password2, string $fio, string $birthday, string $address, string $gender, string $interests, string $vk_profile, string $blood_type, string $Rh_factor
    ) : array
    {
        // TODO: Дописать
        return [];
    }

    public static function signIn(
        string $email, string $password
    ) : string
    {
        if (static::isAuthorized()) {
            return "Вы уже авторизированны";
        }

        $user = UsersTable::get_by_email($email);
        if (!$user) {
            return "Пользователь с таким email не найден";
        }

        if (password_hash($password, PASSWORD_DEFAULT) !== $user['password']) {
            return "Неверно указан пароль";
        }

        $_SESSION['user_id'] = $user['id'];

        return '';
    }

    public static function signOut(): void
    {
        unset($_SESSION['user_id']);
    }

    public static function isAuthorized() : bool
    {
        return (int)($_SESSION['user_id'] ?? 0) > 0;
    }

    public static function currentUser() : array
    {
        if (static::isAuthorized()) {
            return [];
        }

        return UsersTable::get_by_id($_SESSION['user_id']);
    }
}