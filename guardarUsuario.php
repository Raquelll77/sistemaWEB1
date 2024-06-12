
<?php

include 'database.php';
// Procesar la actualización del usuario
// Recuperar los datos del formulario
$idUsuario = $_POST['IDUSUARIO'];
$usuario = $_POST['USUARIO'];
$nombre = $_POST['NOMBRE'];
$correo = $_POST['CORREO'];
$tienda = $_POST['TIENDA'];
$rol = $_POST['ROLL'];

$query = "UPDATE usuarios SET USUARIO = '".$usuario."', NOMBRE = '".$nombre."', CORREO = '".$correo."', TIENDA = '".$tienda."', ROLL = '".$rol."' WHERE IDUSUARIO = '".$idUsuario."'";
if ($conexion->query($query) === TRUE) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error al actualizar usuario: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>