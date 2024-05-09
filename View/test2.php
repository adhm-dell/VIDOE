<?php
require_once '../Controllers/VideoController.php';
require_once '../Controllers/DBController.php';
$db = new DBController();
$db->openConnection();

$controller = new VideoController();
$videos = $controller->searchVideo('test');

print_r($videos);
