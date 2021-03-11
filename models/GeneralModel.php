<?php

namespace models;

use PDO;

class GeneralModel
{
    public $res = null;
    public $conn = null;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function query(string $sql): self
    {
        $this->res = $this->conn->query($sql);
        return $this;
    }

    public function one()
    {
        return $this->res->fetch(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        return $this->res->fetchAll(PDO::FETCH_ASSOC);
    }
}
