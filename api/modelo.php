<?php
require_once 'db.php';

// CREATE
function crearTarea($titulo) {
    global $conexion;
    $sql = $conexion->prepare("INSERT INTO tareas (titulo) VALUES (:titulo)");
    $sql->bindParam(":titulo", $titulo);
    $sql->execute();
}

// READ
function obtenerTareas() {
    global $conexion;
    $sql = $conexion->query("SELECT * FROM tareas ORDER BY id DESC");
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>
