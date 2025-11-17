<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json");

require_once 'modelo.php';

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {

    case 'GET':
        echo json_encode(obtenerTareas());
        break;

    case 'POST':
        $entrada = json_decode(file_get_contents("php://input"), true);
        crearTarea($entrada['titulo']);
        echo json_encode(["mensaje" => "Tarea creada"]);
        break;

    case 'PUT':
        $entrada = json_decode(file_get_contents("php://input"), true);
        actualizarTitulo($entrada['id'], $entrada['titulo'] ?? null);

        if (isset($entrada['completada'])) {
            actualizarEstado($entrada['id'], $entrada['completada']);
        }

        echo json_encode(["mensaje" => "Tarea actualizada"]);
        break;

    case 'DELETE':
        $entrada = json_decode(file_get_contents("php://input"), true);
        eliminarTarea($entrada['id']);
        echo json_encode(["mensaje" => "Tarea eliminada"]);
        break;

    default:
        echo json_encode(["error" => "Método no permitido"]);
}
?>
