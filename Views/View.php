<?php

namespace App\Views;

use App\config\Config;

class View
{
    public static function render($tpl = '', $params = [])
    {
        if (empty($tpl)) {
            $tpl = 'main.tpl.php';
        } else {
            $tpl .= '.tpl.php';
        }
        if (!empty($tpl) && file_exists(Config::VIEWS_DIR . 'layouts/' . $tpl)) {
            $tpl = Config::VIEWS_DIR . 'layouts/' . $tpl;
        }
        extract($params);
        ob_start();
        require_once $tpl;
        return ob_get_clean();
    }
}