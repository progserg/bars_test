<?php
//автозагрузка. подключаем классы
require __DIR__ . '/config/bootstrap.php';

//роутинг
$router = new App\Core\Route();
$router->route();