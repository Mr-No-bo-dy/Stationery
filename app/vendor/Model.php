<?php

namespace app\vendor;

use PDO;

class Model
{
    protected $dbName = 'stationery_db';

    // Connection to DataBase
    public static function builder(): PDO
    {
        return Database::connection();
    }

    // Simple handy var_dump
    public function dd($var): void
    {
        echo '<pre>';
        var_dump($var);
        die;
    }
}