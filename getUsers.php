<?php
// Conexión a la base de datos
$db_host = "localhost";
$db_usuario = "root";
$db_contraseña = "Alvarado18#";
$db_nombre = "sistemaWEB";

$conexion = new mysqli($db_host, $db_usuario, $db_contraseña, $db_nombre);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los usuarios
$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);

$usuarios = array();
if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$conexion->close();

// Devolver los usuarios en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);
?>