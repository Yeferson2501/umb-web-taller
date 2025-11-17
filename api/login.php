<?php
session_start();

if (isset($_POST['usuario'])) {
    $_SESSION["usuario"] = $_POST['usuario'];
    echo "Sesión iniciada para " . $_SESSION["usuario"];
}
?>
