<?php
define('APP', __DIR__);

spl_autoload_register(function ($class_name) {
    $path = __DIR__ . '/' . $class_name . '.php';
    $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    if (!is_file($path)) {
        exit('Файл не найден: ' . $path);
    }
    require_once $path;
});

function vardump(...$agrs)
{
    echo '<pre>';
    var_dump($agrs);
    echo '</pre>';
    die;
}
