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


/**
 * Undocumented function
 *
 * @param array $arr
 * @return array
 */
function arrRand(array $arr): array
{
    $key = array_rand($arr, 1);
    return $arr[$key];
}

/**
 * Undocumented function
 *
 * @param integer $strtotime
 * @return integer
 */
function intervalDay(int $strtotime): int
{
    $interval = time() - $strtotime;
    return round($interval / 86400);
}
