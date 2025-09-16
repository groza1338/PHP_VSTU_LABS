<?php
namespace LR4;
class UsersTable
{
    public static function create(
        string $email, string $password, string $fio, string $birthday, string $address, string $gender, string $interests, string $vk_profile, string $blood_type, string $Rh_factor
    ): void
    {
        $query = Database::prepare(
            'INSERT INTO `users` (email, hash_password, FIO, birthday, address, gender, interests, vk_profile, blood_type, Rh_factor) VALUES (:email, :password, :fio, :birthday, :address, :gender, :interests, :vk_profile, :blood_type, :Rh_factor)'
        );
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $query->bindValue(':fio', $fio);
        $query->bindValue(':birthday', $birthday);
        $query->bindValue(':address', $address);
        $query->bindValue(':gender', $gender);
        $query->bindValue(':interests', $interests);
        $query->bindValue(':vk_profile', $vk_profile);
        $query->bindValue(':blood_type', $blood_type);
        $query->bindValue(':Rh_factor', $Rh_factor);

        if (!$query->execute()) {
            throw new \PDOException('При добавлении пользователя возникла ошибка');
        }
    }

    public static function getByEmail(string $email) : array
    {
        $query = Database::prepare('SELECT * FROM `users` WHERE `email` = :email LIMIT 1');
        $query->bindValue(':email', $email);
        $query->execute();

        $users = $query->fetchAll();

        if (empty($users)) {
            return [];
        }
        return $users[0];
    }

    public static function getById(string $user_id)
    {
        $query = Database::prepare('SELECT * FROM `users` WHERE `id` = :user_id LIMIT 1');
        $query->bindValue(':user_id', $user_id);
        $query->execute();

        $users = $query->fetchAll();

        if (empty($users)) {
            return [];
        }
        return $users[0];
    }
}