<?php

require_once __DIR__ . '/../config/database.php';

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {

            $dsn = 'mysql:host=' . DB_HOST
                . ';dbname=' . DB_NAME
                . ';charset=' . DB_CHARSET;

            try {

                self::$connection = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );

            } catch (PDOException $e) {

                die(
                    'Không thể kết nối Database: '
                    . $e->getMessage()
                );
            }
        }

        return self::$connection;
    }
}