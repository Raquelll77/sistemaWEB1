
<?php
// Procesar la actualización del usuario
// Recuperar los datos del formulario
$idUsuario = $_POST['IDUSUARIO'];
$usuario = $_POST['USUARIO'];
$nombre = $_POST['NOMBRE'];
$correo = $_POST['CORREO'];
$tienda = $_POST['TIENDA'];
$rol = $_POST['ROLL'];

// Realizar la conexión a la base de datos y ejecutar la consulta SQL para actualizar el usuario
$conexion = new mysqli('localhost', 'root', 'Alvarado18#', 'sistemaWEB');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "UPDATE usuarios SET USUARIO = '".$usuario."', NOMBRE = '".$nombre."', CORREO = '".$correo."', TIENDA = '".$tienda."', ROLL = '".$rol."' WHERE IDUSUARIO = '".$idUsuario."'";
if ($conexion->query($query) === TRUE) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error al actualizar usuario: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>