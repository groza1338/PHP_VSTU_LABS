<?php

class Database
{
    private static ?Database $instance = null;

    private ?PDO $connection = null;

    protected function __construct()
    {
        $this->connection = new PDO(
            'mysql:host=127.0.0.1;dbname=LR5',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    protected function __clone() {

    }

    public function __wakeup() {
        throw new \BadMethodCallException("Unable to deserialize database connection.");
    }

    public static function GetInstance() : Database {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public static function connection() : \PDO
    {
        return static::GetInstance()->connection;
    }

    public static function prepare($statement) : \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    public static function lastInsertId() : int
    {
        return (int)static::connection()->lastInsertId();
    }
}