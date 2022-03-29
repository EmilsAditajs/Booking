<?php

namespace App;

class Database
{
    private static $connection = null;

    public static function connection()
    {
        if (self::$connection === null) {
            $connectionParams = [
                'dbname' => 'BookinApp',
                'user' => 'root',
                'password' => 'qwertyui',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            self::$connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        }
        return self::$connection;
    }
}