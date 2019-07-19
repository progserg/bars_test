<?php

namespace App\Core;

use App\config\Config;

class Route
{
    protected $controller;
    protected $action;
    protected $params = [];

    public function __construct()
    {
        $request = $_GET['path'];
        $parts = explode("/", $request);
        $this->controller = Config::DEFAULT_CONTROLLER;
        $this->action = Config::DEFAULT_ACTION;

        if (is_array($parts)) {
            if (count($parts) > 0) {
                if (!empty($parts[0])) {
                    $controller = '\\App\\Controllers\\' . ucfirst($parts[0]) . 'Controller';
                    if (class_exists($controller)) {
                        $this->controller = $controller;
                    } else {
                        self::redirect(Config::DEFAULT_URL);
                    }
                    unset($parts[0]);
                }
                if (isset($parts[1]) && !empty($parts[1])) {
                    $this->action = $parts[1];
                    unset($parts[1]);
                }
            }
        }
        if ($this->action == '' || !method_exists($this->controller, $this->action . 'Action')) {
            $this->action = Config::DEFAULT_ACTION;
        }
        $this->params = array_merge($_GET, $_POST, $parts);
        $this->controller = new $this->controller($this->params);
        $this->action .= 'Action';
        if (!method_exists($this->controller, $this->action)) {
            $this->action = Config::DEFAULT_ACTION . 'Action';
        }
    }

    public function route()
    {
        $this->controller->{$this->action}();
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}