<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Conexión a la base de datos (reemplaza los valores con los de tu conexión)
    $db_host = "localhost";
    $db_usuario = "root";
    $db_contraseña = "Alvarado18#";
    $db_nombre = "sistemaWEB";

    $conexion = new mysqli($db_host, $db_usuario, $db_contraseña, $db_nombre);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Convertir la contraseña ingresada por el usuario a MD5
    $contraseña_md5 = md5($contraseña);

    // Consulta SQL para verificar el usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE USUARIO='$usuario' AND CONTRASEÑA='$contraseña_md5'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        // Iniciar sesión (opcional, dependiendo de tu aplicación)
        session_start();
        $_SESSION["USUARIO"] = $usuario;        
        // Redirigir a la página de inicio o a donde desees
        header("Location: inicio.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }

    $conexion->close();
}
?>
