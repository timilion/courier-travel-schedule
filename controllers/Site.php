<?php

namespace controllers;

use core\Controller;
use Exception;
use models\Couriers;
use models\Region;
use models\Scheme;

class Site extends Controller
{
    public function index()
    {
        $model = (new Scheme())->getAll();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function create()
    {

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $model = new Scheme();
            $body = $this->bodyParams();
            if ($body  && $model->load($body)) {
                $result = $model->save();
                return $this->asJson($result);
            }
        }

        if ($_SERVER["REQUEST_METHOD"] === 'GET') {
            $regions = (new Region())->getAll();
            $couriers = (new Couriers())->getAll();
            return $this->render('create', [
                'regions' => $regions,
                'couriers' => $couriers
            ]);
        }

        throw new Exception('error request');
    }
}
