<?php

namespace models;

use PDO;

class Couriers extends GeneralModel
{
    public function getAll()
    {
        return $this->query('SELECT * FROM couriers')->all();
    }

    public function getCoruier(int $id)
    {
        return $this->query("SELECT * FROM `couriers` WHERE `id`= '$id'")->one();
    }
}
