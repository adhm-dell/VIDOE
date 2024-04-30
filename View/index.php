<?php
require_once '../Controllers/DBController.php';

$db = new DBController;

if ($db->openConnection()) {
    echo 'Connection successful';
} else {
    echo 'Connection failed';
}
