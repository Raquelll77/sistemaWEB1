<?php

include 'database.php';

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