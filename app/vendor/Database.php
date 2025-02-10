<?php

namespace app\vendor;

use PDO;

class Database
{
    private static $connection;

    // Connect to Database & return PDO object
    public static function connection(): PDO
    {
        if (is_null(self::$connection)) {
            $credentials = require 'env.php';
            $host = $credentials['host'];
            $db = $credentials['db'];
            $user = $credentials['user'];
            $pass = $credentials['pass'];
            $charset = 'utf8';
            $dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=' . $charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            self::$connection = new PDO($dsn, $user, $pass, $options);
        }

        return self::$connection;
    }
}