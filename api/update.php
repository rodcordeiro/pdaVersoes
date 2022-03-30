<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../db/db.class.php';
include_once '../controllers/controller.php';

$dbclass = new Database();
$connection = $dbclass->getConnection();

$controller = new Controller($connection);

$data = json_decode(file_get_contents("php://input"));

print_r($data);
$controller->id_sistema = $data->idSistema;
$controller->sistema = $data->nomeSistema;
$controller->cliente = $data->clienteSistema;
$controller->versao = $data->versaoSistema;

$controller->id = $data->id;

try {
    $system = $controller->update();
    $message = array('id' => $system);
    http_response_code(200);
    echo json_encode($message);
} catch (Exception $e) {
    $message = array('id' =>  $e->getMessage());
    echo json_encode($message);
}
