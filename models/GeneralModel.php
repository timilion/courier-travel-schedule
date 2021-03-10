<?php

namespace models;

use PDO;
use core\DataBase;


class GeneralModel
{
    public $db = null;

    public function __construct()
    {
        $this->db = (new DataBase())->connect();
    }
}
