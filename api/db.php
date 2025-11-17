<?php
$host = "db.yvcmiscsfsossipqwnyz.supabase.co";
$dbname = "postgres";
$port = "5432";
$user = "postgres";
$password = "@UMB.1611202";

try {
    $conexion = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );
    
    // Activar errores de PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
