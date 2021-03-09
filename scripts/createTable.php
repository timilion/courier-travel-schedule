<?php

use core\DataBase;


require_once '../func.php';
$data = require '../data.php';
$db = new DataBase();
$conn = $db->connect();
$dbName = 'tbl_task';


if (!$conn->query("SHOW TABLES FROM `" . $dbName . "` LIKE 'regions'")->fetch()) {
    $sqlRegionsCreate = "CREATE TABLE IF NOT EXISTS `regions` (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        city VARCHAR(30) NOT NULL UNIQUE,
        duration INT NOT NULL
    )";
    $conn->query($sqlRegionsCreate);
    $sqlRegionsArray = [];
    foreach ($data['regions'] as $city => $duration) {
        $sqlRegionsArray[] = "('" . $city . "', '" . $duration . "')";
    }
    $conn->query("INSERT INTO `regions` (`city`, `duration`) VALUES " . implode(',', $sqlRegionsArray));
    echo "Сreated and filled in a table with regions" . PHP_EOL;
}


if (!$conn->query("SHOW TABLES FROM `" . $dbName . "` LIKE 'couriers'")->fetch()) {
    $sqlCouriersCreate = "CREATE TABLE IF NOT EXISTS `couriers` (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(30) NOT NULL UNIQUE
    )";


    $sqlCouriers = array_map(fn ($item) => "('" . $item . "')", $data['couriers']);
    $conn->query($sqlCouriersCreate);
    $conn->query("INSERT INTO `couriers` (`full_name`) VALUES " . implode(',', $sqlCouriers));
    echo "Сreated and filled in a table with couriers" . PHP_EOL;
}


$db->closeConnect();
