<?php
session_start();
set_include_path('.');

include 'app/config.php';
include 'app/Cars.php';

$cars = new Cars();

foreach ($cars->getAll() as $car) {
    echo $car['full_name'] . ' ' . $car['brand'] . ' ' . $car['model'] . ' ' . $car['year'] . '<br>';
};
