<?php

namespace App\Core;

use App\config\ConfigDb;

class Db extends \PDO
{
    private static $_conn;

    public function __construct()
    {
        $settings = ConfigDb::getConfig();
        $host = $settings['host'];
        $port = $settings['port'];
        $dbName = $settings['dbName'];
        $user = $settings['user'];
        $password = $settings['password'];
        $charset = $settings['charset'];

        $dns = "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset";

        parent::__construct($dns, $user, $password);
    }

    public static function get()
    {
        if (is_null(self::$_conn)) {
            self::$_conn = new self();
        }
        return self::$_conn;
    }
}