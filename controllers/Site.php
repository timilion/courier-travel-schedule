<?php

namespace controllers;

use core\Controller;
use models\Scheme;

class Site extends Controller
{
    public function index()
    {
        $model = (new Scheme())->getAll();
        $this->render('index', [
            'model' => $model
        ]);
    }
}
