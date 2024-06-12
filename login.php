<?php

include 'database.php';
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    

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
        echo "CREDENCIALES INVALIDAS";
        header("Location: index.html");        
        
    }

    $conexion->close();
}
?>
