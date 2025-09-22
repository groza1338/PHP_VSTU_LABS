<?php

namespace LR4;

use PDO;

class Database
{
    private static ?Database $instance = null;

    private ?PDO $connection = null;

    protected function __construct()
    {
        $host = $this->env('DB_HOST');

        $port = $this->env('DB_PORT');
        $db = $this->env('DB_NAME');

        $dsn = "mysql:host={$host};port={$port};dbname={$db}";
        $user = $this->env('DB_USERNAME');
        $password = $this->env('DB_PASSWORD');

        $this->connection = new PDO(

            $dsn,
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    protected function __clone()
    {

    }

    public function __wakeup()
    {
        throw new \BadMethodCallException("Unable to deserialize database connection.");
    }

    public static function GetInstance(): Database
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public static function connection(): \PDO
    {
        return static::GetInstance()->connection;
    }

    public static function prepare($statement): \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    public static function lastInsertId(): int
    {
        return (int)static::connection()->lastInsertId();
    }

    private function env(string $key, ?string $default = null): ?string
    {
        // Берём из $_ENV, потом $_SERVER, потом getenv()
        $val = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($val === false || $val === null || $val === '') {
            return $default;
        }
        return $val;
    }
}