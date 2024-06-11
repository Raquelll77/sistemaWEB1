<?php
// Verificar si se ha enviado un ID de usuario y los datos del usuario
if(isset($_POST['IDUSUARIO']) && isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['tienda']) && isset($_POST['rol'])) {
    $idUsuario = $_POST['idUsuario'];
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $tienda = $_POST['tienda'];
    $rol = $_POST['rol'];

    // Realizar la conexión a la base de datos y actualizar los datos del usuario
    $conexion = new mysqli('localhost', 'root', 'Alvarado18#', 'sistemaWEB');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "UPDATE usuarios SET Usuario='$usuario', Nombre='$nombre', Correo='$correo', Tienda='$tienda', Rol='$rol' WHERE IDUSUARIO=$idUsuario";
    if ($conexion->query($query) === TRUE) {
        // Redirigir a inicio.php después de la actualización
        header("Location: inicio.php");
        exit();
    } else {
        echo "Error al actualizar usuario: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    die("Datos de usuario incompletos");
}
?>
