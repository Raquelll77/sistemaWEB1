<?php 
    // Realizar la conexión a la base de datos y obtener los datos del usuario con el ID proporcionado
    $conexion = new mysqli('localhost', 'root', 'Alvarado18#', 'sistemaWEB');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
?>