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
        $full_name = $this->requestParams['full_name'] ?? false;
        $brand = $this->requestParams['brand'] ?? '';
        $model = $this->requestParams['model'] ?? '';
        $year = $this->requestParams['year'] ?? '';
        if ($brand && $model && $year) {
            $cars = new Cars();
            $cars->create($brand, $model, $year, $full_name);
        }
        header('Location: /');
    }
}