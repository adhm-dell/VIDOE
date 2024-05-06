<?php
require_once '../Controllers/DBController.php';
require_once '../Controllers/VideoController.php';


$controller = new VideoController();

$name = $controller->searchVideo('te');

var_dump($name);
