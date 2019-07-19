<?php

namespace App\config;

class ConfigDb
{
    const HOST = 'localhost';
    const PORT = 3306;
    const DB_NAME = 'bars';
    const USER = 'root';
    const PASSWORD = '123456';
    const CHARSET = 'utf8';

    public static function getConfig()
    {
        return [
            'host' => self::HOST,
            'port' => self::PORT,
            'dbName' => self::DB_NAME,
            'user' => self::USER,
            'password' => self::PASSWORD,
            'charset' => self::CHARSET,
        ];
    }
}