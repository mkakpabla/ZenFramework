<?php

namespace Framework\Database;

use Zen\Database\Query;


class DB 
{
    public static function pdo()
    {
        $params = Env::config('database');
        return new PDO(
            'mysql:host=' . $params['host'] . ';dbname=' . $params['name'],
            $params['username'],
            $params['password'],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public static function query()
    {
        return new Query(self::pdo);
    }
}