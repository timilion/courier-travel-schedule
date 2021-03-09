<?php

namespace controllers;

use core\Controller;

class Site extends Controller
{
    public function index()
    {
        $this->render('index');
    }
}
