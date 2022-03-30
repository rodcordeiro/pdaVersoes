<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../db/db.class.php';
include_once '../controllers/controller.php';

$dbclass = new Database();
$connection = $dbclass->getConnection();

$controller = new Controller($connection);

$data = json_decode(file_get_contents("php://input"));
print_r($data);
$controller->id = $data->id;

if ($controller->delete()) {
    $message = array('message' => 'System deleted');
    echo json_encode($message);
} else {
    $message = array('message' => 'Unable to update the system data');
    echo json_encode($message);
}
