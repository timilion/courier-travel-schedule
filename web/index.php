<?php

use core\DataBase;


require_once '../func.php';

$rewrite = require '../config/rewrite.php';
$db = new DataBase();
$conn = $db->connect();
(new core\Application())->run($rewrite);
$db->closeConnect();
