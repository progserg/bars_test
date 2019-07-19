<?php

namespace App\Controllers;

abstract class BaseController
{
    protected $_params;

    protected $model;

    public function __construct($_params = [])
    {
        $this->_params = $_params;
    }
}