<?php
// login.php
// Simulación de inicio/cierre de sesión usando PHP sessions
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Responder OPTIONS para CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST') {
    // Login: recibir { "usuario": "..." }
    $body = json_decode(file_get_contents("php://input"), true);
    if (!isset($body['usuario']) || trim($body['usuario']) === '') {
        http_response_code(400);
        echo json_encode(["error" => "Campo 'usuario' obligatorio"]);
        exit;
    }
    $_SESSION['usuario'] = $body['usuario'];
    // Opcional: agregar un id o rol en la sesión
    echo json_encode(["mensaje" => "Sesión iniciada", "usuario" => $_SESSION['usuario']]);
    exit;
}

if ($metodo === 'GET') {
    // Comprobar sesión activa
    if (isset($_SESSION['usuario'])) {
        echo json_encode(["logueado" => true, "usuario" => $_SESSION['usuario']]);
    } else {
        echo json_encode(["logueado" => false]);
    }
    exit;
}

if ($metodo === 'DELETE') {
    // Logout
    session_unset();
    session_destroy();
    echo json_encode(["mensaje" => "Sesión cerrada"]);
    exit;
}

// Métodos no permitidos
http_response_code(405);
echo json_encode(["error" => "Método no permitido"]);
?>
