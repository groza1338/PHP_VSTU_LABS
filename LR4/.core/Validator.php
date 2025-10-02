<?php
namespace LR4;
use DateTime;

class Validator
{
    private static array $errors = [];
    
    public static function getErrors(): array
    {
        return self::$errors;
    }

    public static function emptyErrors(): void
    {
        self::$errors = [];
    }
    
    public static function validateEmail(string $email) : void 
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors[] = "Некорректный адрес почты";
        }

        if (strlen($email) > 255) {
            self::$errors[] = "В почте не должно быть больше 255 символов";
        }
    }

    public static function validatePassword(string $password, string $password2) : void
    {
        if ($password !== $password2) {
            self::$errors[] = "Введенные пароли не совпадают";
        }

        if (strlen($password) <= 6) {
            self::$errors[] = "Пароль должен быть длиннее 6 символов";
        }

        if (strlen($password) > 255) {
            self::$errors[] = "Пароль должен быть короче 256 символов";
        }

        if (!preg_match("/[A-Z]/", $password)) {
            self::$errors[] = "Пароль должен содержать хотя бы одну заглавную латинскую букву";
        }

        if (!preg_match("/[a-z]/", $password)) {
            self::$errors[] = "Пароль должен содержать хотя бы одну строчную латинскую букву";
        }

        if (!preg_match("/[\W_]/", $password)) {
            self::$errors[] = "Пароль должен содержать хотя бы один спецсимвол (например, !, @, #, $, %, &, *, и т.д.)";
        }

        if (!preg_match("/[ \-_]/", $password)) {
            self::$errors[] = "Пароль должен содержать пробел, дефис или подчеркивание";
        }

        if (preg_match("/[А-я]/u", $password)) {
            self::$errors[] = "Пароль не должен содержать русские буквы";
        }

        if (!preg_match("/\d/", $password)) {
            self::$errors[] = "Пароль должен содержать хотя бы одну цифру";
        }
    }

    public static function validateFio(string $fio) : void
    {
        if (!preg_match("/[А-ЯËA-Z][а-яёa-z]+ [А-ЯËA-Z][а-яёa-z]+ [А-ЯËA-Z][а-яёa-z]+/u", $fio)) {
            self::$errors[] = "ФИО должно быть в формате: Фамилия Имя Отчество (с заглавной буквы)";
        }

        if (strlen($fio) > 255) {
            self::$errors[] = "В ФИО не должно быть больше 255 символов";
        }
    }

    public static function validateBirthday(string $birthday) : void
    {
        $today = new DateTime();
        $minDate = new DateTime();
        $minDate = $minDate->modify('-150 years');

        $input_date = DateTime::createFromFormat('Y-m-d', $birthday);

        if (!$input_date) {
            self::$errors[] = "Неверный формат даты. Используйте формат: ГГГГ-ММ-ДД";
        }

        if ($input_date > $today) {
            self::$errors[] = "Дата не может быть в будущем";
        }

        if ($input_date < $minDate) {
            self::$errors[] = "Дата не может быть раньше 150 лет назад";
        }
    }

    public static function validateGender(string $gender) : void
    {
        if (!in_array($gender, ['male', 'female'])) {
            self::$errors[] = "Выбран несуществующий пол";
        }
    }

    public static function validateVkProfile(string $vkProfile) : void
    {
        if (!filter_var($vkProfile, FILTER_VALIDATE_URL) || !preg_match("/vk.com/", $vkProfile)) {
            self::$errors[] = "Вы ввели неверную ссылку на профиль ВК";
        }

        if (strlen($vkProfile) > 255) {
            self::$errors[] = "В ссылке на профиль ВК не должно быть больше 255 символов";
        }
    }

    public static function validateBloodType(string $bloodType) : void
    {
        if (!in_array($bloodType, ['1', '2', '3', '4'])) {
            self::$errors[] = "Выбрана несуществующая группа крови";
        }
    }

    public static function validateRHFactor(string $rhFactor) : void
    {
        if (!in_array($rhFactor, ['+', '-'])) {
            self::$errors[] = "Выбран несуществующий резус-фактор";
        }
    }

    public static function validateInterest(string $interest) : void
    {
        if (strlen($interest) > 255) {
            self::$errors[] = "В интересах не должно быть более 255 символов";
        }
    }

    public static function validateAddress(string $address) : void
    {
        if (strlen($address) > 255) {
            self::$errors[] = "В адресе не должно быть более 255 символов";
        }
    }
}