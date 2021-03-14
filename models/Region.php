<?php

namespace models;

class Region extends GeneralModel
{

    public function getAll()
    {
        return $this->query('SELECT * FROM regions')->all();
    }
}
