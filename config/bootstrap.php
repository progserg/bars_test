<?php

require_once __DIR__ . '/Config.php';

use App\config\Config;

function loadClasses($classname)
{
    $classname = str_replace('App\\', '', $classname);
    $file = Config::BASE_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
}
spl_autoload_register('loadClasses');