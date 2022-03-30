<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/dbclass.php';
include_once '../controllers/controller.php';

$dbclass = new Database();
$connection = $dbclass->getConnection();

$controller = new Controller($connection);

$data = json_decode(file_get_contents("php://input"));

$controller->id_sistema = $data->idSistema;
$controller->sistema = $data->nomeSistema;
$controller->cliente = $data->clienteSistema;
$controller->versao = $data->versaoSistema;
$controller->id = $data->id;

if ($controller->update()) {
    $message = array('message' => 'System updated');
    echo json_encode($message);
} else {
    $message = array('message' => 'Unable to update the system data');
    echo json_encode($message);
}
