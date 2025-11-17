<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

require_once 'modelo.php';

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        echo json_encode(obtenerTareas());
        break;

    case 'POST':
        $body = json_decode(file_get_contents("php://input"), true);
        crearTarea($body["titulo"]);
        echo json_encode(["mensaje" => "Tarea creada"]);
        break;

    default:
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
