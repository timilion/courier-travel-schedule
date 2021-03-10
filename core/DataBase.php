<?php

namespace core;

use Exception;
use PDO;
use PDOException;

/**
 * [DataBase description]
 */
class DataBase
{
    public function connect()
    {
        try {
            $config = require APP . '/config/db.php';
            return new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'], $config['username'], $config['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $config['charset']]);
        } catch (PDOException $pe) {
            throw new Exception('Error connect database');
        }
    }


    public function closeConnect()
    {
        $this->db = null;
    }
}
