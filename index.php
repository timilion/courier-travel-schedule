<?php


use config\DataBase;

define('APP', __DIR__);

spl_autoload_register(function ($class_name) {
    $path = __DIR__ . '/' . $class_name . '.php';
    $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    if (!is_file($path)) {
        exit('Файл не найден: ' . $path);
    }
    require_once $path;
});

$rewrite = require './config/rewrite.php';
$db = new DataBase();
$db->connect();


$route = isset($rewrite[$_SERVER['REQUEST_URI']]) ? $rewrite[$_SERVER['REQUEST_URI']] : null;
if ($route) {
    extract($route);
    $model = new $class();
    if (method_exists($model, $action)) {
        $model->$action();
        die;
    }
    notFound();
} else {
    notFound();
}


function vardump(...$agrs)
{
    echo '<pre>';
    var_dump($agrs);
    echo '</pre>';
    die;
}

function notFound()
{
    http_response_code(404);
    die;
}
