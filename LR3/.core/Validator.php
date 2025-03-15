<?php

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
    }

    public static function validatePassword(string $password, string $password2) : void
    {
        if ($password !== $password2) {
            self::$errors[] = "Введенные пароли не совпадают";
        }

        if (strlen($password) <= 6) {
            self::$errors[] = "Пароль должен быть длиннее 6 символов";
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
        if (!filter_var($vkProfile, FILTER_VALIDATE_URL)) {
            self::$errors[] = "Вы ввели неверную ссылку";
        }

        // Получаем HTML контент страницы через file_get_contents
        $html = @file_get_contents($vkProfile);

        // Проверяем, если страница не найдена (например, ошибка 404)
        if ($html === false) {
            self::$errors[] = "Страница не найдена.";
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
}