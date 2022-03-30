<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../db/db.class.php';
include_once '../controllers/controller.php';

$dbclass = new Database();
$connection = $dbclass->getConnection();
$controller = new Controller($connection);
if($_GET['id']){
    $systems = $controller->findById($_GET['id']);
} else {
$systems = $controller->read();
}
echo json_encode($systems);
