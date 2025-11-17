<?php
require_once 'db.php';

// ------------------------
// CREATE
// ------------------------
function crearTarea($titulo) {
    global $conexion;
    $titulo = htmlspecialchars($titulo);

    $query = "INSERT INTO tareas (titulo, completada) VALUES ($1, false)";
    pg_query_params($conexion, $query, [$titulo]);
}

// ------------------------
// READ
// ------------------------
function obtenerTareas() {
    global $conexion;

   $query = "SELECT * FROM tareas ORDER BY id ASC";
   $resultado = pg_query($conexion, $query);

    $tareas = [];
    while ($fila = pg_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

// ------------------------
// UPDATE título
// ------------------------
function actualizarTitulo($id, $titulo) {
    global $conexion;

    $query = "UPDATE tareas SET titulo=$1 WHERE id=$2";
    pg_query_params($conexion, $query, [$titulo, $id]);
}

// ------------------------
// UPDATE estado
// ------------------------
function actualizarEstado($id, $completada) {
    global $conexion;

    $query = "UPDATE tareas SET completada=$1 WHERE id=$2";
    pg_query_params($conexion, $query, [$completada, $id]);
}

// ------------------------
// DELETE
// ------------------------
function eliminarTarea($id) {
    global $conexion;

    $query = "DELETE FROM tareas WHERE id=$1";
    pg_query_params($conexion, $query, [$id]);
}
?>
