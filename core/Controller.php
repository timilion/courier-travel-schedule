<?php

namespace core;

use Exception;
use core\traits\TraitController;

class Controller
{
    use TraitController;

    public $title = 'Home';

    public function render(string $file, array $options = [])
    {
        $folder = $this->getFolder();
        $path = APP . '/views/' . $folder . '/' . $file . '.php';
        if (file_exists($path)) {
            $content = $this->getContent($path,  $options);
            return $this->getContent(APP . '/views/layauts/main.php',  ['content' => $content]);
        }
        throw new Exception('not found file');
    }

    public function bodyParams()
    {
        return json_decode(file_get_contents('php://input'));
    }

    public function asJson($param)
    {
        return json_encode($param);
    }
}
