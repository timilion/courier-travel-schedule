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
        $result = $this->res->fetch(PDO::FETCH_ASSOC);
        $this->res = null;
        return $result;
    }

    public function all()
    {
        $result = $this->res->fetchAll(PDO::FETCH_ASSOC);
        $this->res = null;
        return $result;
    }

    public function bindType(string $type)
    {
        switch ($type) {
            case 'int':
                return PDO::PARAM_INT;
            case 'string':
                return PDO::PARAM_STR;
            case 'bool':
                return PDO::PARAM_BOOL;
            default:
                return PDO::PARAM_NULL;
        }
    }
}
