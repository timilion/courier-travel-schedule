<?php

namespace config;

use Exception;
use PDO;
use PDOException;

/**
 * [DataBase description]
 */
class DataBase
{
    public static $db;


    public function __construct()
    {

        self::$db = $this->connect();
    }

    /**
     * Undocumented function
     *
     * @return PDO
     */
    public function connect(): PDO
    {
        $host = 'localhost';
        $dbname = 'bazismed';
        $username = 'root';
        $password = 'root';

        try {
            return new PDO("mysql:host={$host};dbname={$dbname}", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
        } catch (PDOException $pe) {
            throw new Exception('Error connect database');
        }
    }

    /**
     * Undocumented function
     *
     * @param string $sql
     * @return void
     */
    public static function query(string $sql)
    {

        $smtp = self::$db->query($sql);
        if ($smtp) {
            return $smtp->fetchAll(PDO::FETCH_ASSOC);
        }
        return $smtp;
    }
}
