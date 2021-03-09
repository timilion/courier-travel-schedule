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
            require_once APP . '/views/layauts/main.php';
            die;
        }
        throw new Exception('not found file');
    }
}
