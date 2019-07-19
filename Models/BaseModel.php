<?php

namespace App\Models;

use App\Core\Db;

abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::get();
    }

    abstract public function getAll();

    public function setData($data = [])
    {
        foreach ($data as $key => $val) {
            $this->{$key} = $val;
        }
    }
}