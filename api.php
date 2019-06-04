<?php
session_start();
set_include_path('.');

include 'app/config.php';
include 'app/CarsApi.php';

try {
    $api = new CarsApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
