<?php

class Validator
{
    public static function validateEmail(string $email) : ?string {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Некорректный адрес почты";
        }
        return null;
    }

    public static function validatePassword(string $password, string $password2) : ?string {
        if ($password !== $password2) {
            return "Введенные пароли не совпадают";
        }

        if (strlen($password) <= 6) {
            return "Пароль должен быть длиннее 6 символов";
        }

        if (!preg_match("/[A-Z]/", $password)) {
            return "Пароль должен содержать хотя бы одну заглавную латинскую букву";
        }

        if (!preg_match("/[a-z]/", $password)) {
            return "Пароль должен содержать хотя бы одну строчную латинскую букву";
        }

        if (!preg_match("/[\W_]/", $password)) {
            return "Пароль должен содержать хотя бы один спецсимвол (например, !, @, #, $, %, &, *, и т.д.)";
        }

        if (!preg_match("/[ \-_]/", $password)) {
            return "Пароль должен содержать пробел, дефис или подчеркивание";
        }

        if (preg_match("/[А-я]/u", $password)) {
            return "Пароль не должен содержать русские буквы";
        }

        if (!preg_match("/\d/", $password)) {
            return "Пароль должен содержать хотя бы одну цифру";
        }

        return null;
    }

    public static function validateFio(string $fio) : ?string
    {
        if (!preg_match("/[А-ЯËA-Z][а-яёa-z]+ [А-ЯËA-Z][а-яёa-z]+ [А-ЯËA-Z][а-яёa-z]+/u", $fio)) {
            return "ФИО должно быть в формате: Фамилия Имя Отчество (с заглавной буквы)";
        }

        return null;
    }

    public static function validateBirthday(string $birthday) : ?string
    {
        $today = new DateTime();
        $minDate = new DateTime();
        $minDate = $minDate->modify('-150 years');

        $input_date = DateTime::createFromFormat('Y-m-d', $birthday);

        if (!$input_date) {
            return "Неверный формат даты. Используйте формат: ГГГГ-ММ-ДД";
        }

        if ($input_date > $today) {
            return "Дата не может быть в будущем";
        }

        if ($input_date < $minDate) {
            return "Дата не может быть раньше 150 лет назад";
        }

        return null;
    }

    public static function validateGender(string $gender) : ?string
    {
        if (!in_array($gender, ['male', 'female'])) {
            return "Выбран несуществующий пол";
        }

        return null;
    }

    public static function validateVkProfile(string $vkProfile) : ?string
    {
        if (!filter_var($vkProfile, FILTER_VALIDATE_URL)) {
            return "Вы ввели неверную ссылку";
        }

        // Получаем HTML контент страницы через file_get_contents
        $html = @file_get_contents($vkProfile);

        // Проверяем, если страница не найдена (например, ошибка 404)
        if ($html === false) {
            return "Страница не найдена.";
        }

        // Создаём объект DOMDocument
        $dom = new DOMDocument();

        // Для того, чтобы избежать предупреждений о невалидном HTML
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Ищем все элементы с классом "ProfileInfo"
        $xpath = new DOMXPath($dom);
        $elements = $xpath->query('//*[@class="ProfileInfo"]');

        // Проверяем, если элементы найдены
        if ($elements->length === 0) {
            return "Это ссылка не на профиль ВК!";
        }

        return null;
    }

    public static function validateBloodType(string $bloodType) : ?string
    {
        if (!in_array($bloodType, ['I', 'II', 'III', 'IV'])) {
            return "Выбрана несуществующая группа крови";
        }

        return null;
    }

    public static function validateRHFactor(string $rhFactor) : ?string
    {
        if (!in_array($rhFactor, ['+', '-'])) {
            return "Выбран несуществующий резус-фактор";
        }

        return null;
    }

}