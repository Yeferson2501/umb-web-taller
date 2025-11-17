<?php
// controlador.php
// Encapsula la lógica del endpoint usando las funciones de modelo.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Responder OPTIONS para CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once 'modelo.php';

function handleGet() {
    $tareas = obtenerTareas();
    echo json_encode($tareas);
}

function handlePost($body) {
    if (!isset($body['titulo']) || trim($body['titulo']) === '') {
        http_response_code(400);
        echo json_encode(["error" => "El título es obligatorio"]);
        return;
    }
    crearTarea($body['titulo']);
    echo json_encode(["mensaje" => "Tarea creada"]);
}

function handlePut($body) {
    if (!isset($body['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "ID obligatorio para actualizar"]);
        return;
    }
    $id = $body['id'];

    if (isset($body['titulo'])) {
        actualizarTitulo($id, $body['titulo']);
    }
    if (isset($body['completada'])) {
        // Asegurar valor booleano/int válido
        $val = $body['completada'] ? true : false;
        actualizarEstado($id, $val);
    }
    echo json_encode(["mensaje" => "Tarea actualizada"]);
}

function handleDelete($body) {
    if (!isset($body['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "ID obligatorio para eliminar"]);
        return;
    }
    eliminarTarea($body['id']);
    echo json_encode(["mensaje" => "Tarea eliminada"]);
}

// Dispatcher simple
$metodo = $_SERVER['REQUEST_METHOD'];
$body = json_decode(file_get_contents("php://input"), true);

switch ($metodo) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost($body ?? []);
        break;
    case 'PUT':
        handlePut($body ?? []);
        break;
    case 'DELETE':
        handleDelete($body ?? []);
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
