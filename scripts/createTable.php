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



if (!$conn->query("SHOW TABLES FROM `" . $dbName . "` LIKE 'scheme'")->fetch()) {

    $sqlSchemeCreate = "CREATE TABLE `scheme` (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    region VARCHAR(255) NOT NULL,
    departure_date INT NOT NULL,
    courier_name VARCHAR(255) NOT NULL,
    arrival_date INT NOT NULL,
    #INDEX (region, courier_name),
    FOREIGN KEY (`region`) REFERENCES `regions`(`city`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`courier_name`) REFERENCES `couriers`(`full_name`) ON DELETE CASCADE ON UPDATE CASCADE
    )";
    $conn->query($sqlSchemeCreate);
    echo "Сreated and filled in a table with scheme" . PHP_EOL;
}


$cityArray = $conn->query("SELECT * FROM `regions`")->fetchAll(PDO::FETCH_ASSOC);
$couriersArray = $conn->query("SELECT * FROM `couriers`")->fetchAll(PDO::FETCH_ASSOC);


$period = intervalDay(strtotime("12-06-2019"));

//TODO: проверить
for ($i = 0; $i < $period; $i++) {
    $city = arrRand($cityArray); //city, duration
    $couries = arrRand($couriersArray); //full_name
    $full_name = $couries['full_name'];
    $duration = $city['duration'];
    $currentTime = strtotime("12-06-2019") + 3600 * $i;


    $stmt  = $conn->prepare("SELECT * FROM scheme WHERE courier_name = ?");
    $stmt->execute([$full_name]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row || ($row  && $currentTime > $row['arrival_date'])) {
        $arrival_date = $currentTime + 86400 * $duration;
        $conn->query("INSERT INTO `scheme` (`id`, `region`, `departure_date`, `courier_name`,`arrival_date`) VALUES (NULL,'$city[city]', '$currentTime', '$full_name', '$arrival_date')");
    }
}


$db->closeConnect();
