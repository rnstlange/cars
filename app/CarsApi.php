<?php

include 'app/Cars.php';
include 'app/Api.php';

class CarsApi extends Api
{
    public $apiName = 'cars';
    public $requestUri = ['GET', 'POST'];

    public function indexAction()
    {
        $cars = new Cars();
        return $this->response($cars->getAll(), 200);
    }

    public function createAction()
    {
        $cars = new Cars();

    }
}