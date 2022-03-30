<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT,PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../db/db.class.php';
include_once '../controllers/controller.php';

$dbclass = new Database();
$connection = $dbclass->getConnection();

$controller = new Controller($connection);

$data = json_decode(file_get_contents("php://input"));

if (isset($data->idSistema)) {
    $controller->id_sistema = $data->idSistema;
}
if (isset($data->nomeSistema)) {
    $controller->sistema = $data->nomeSistema;
}
if (isset($data->clienteSistema)) {
    $controller->cliente = $data->clienteSistema;
}
if (isset($data->versaoSistema)) {
    $controller->versao = $data->versaoSistema;
}
$controller->id = $data->id;

if ($controller->update()) {
    $message = array('message' => 'System updated');
    echo json_encode($message);
} else {
    $message = array('message' => 'Unable to update the system data');
    echo json_encode($message);
}
