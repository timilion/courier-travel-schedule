<?php


require_once 'func.php';

$rewrite = require './config/rewrite.php';

(new core\Application($rewrite))->run();
