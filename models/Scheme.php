<?php

namespace models;

class Scheme extends GeneralModel
{
    public function getAll()
    {
        return $this->query('SELECT * FROM scheme')->all();
    }
}
