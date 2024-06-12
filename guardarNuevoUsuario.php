<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['USUARIO'];
    $nombre = $_POST['NOMBRE'];
    $correo = $_POST['CORREO'];
    $tienda = $_POST['TIENDA'];
    $rol = $_POST['ROLL'];
    $contraseña = $_POST['CONTRASEÑA'];

    // Validar y sanitizar datos
    $usuario = $conexion->real_escape_string($usuario);
    $nombre = $conexion->real_escape_string($nombre);
    $correo = $conexion->real_escape_string($correo);
    $tienda = $conexion->real_escape_string($tienda);
    $rol = $conexion->real_escape_string($rol);
    $contraseña = $conexion->real_escape_string($contraseña);

    // Convertir la contraseña a md5
    $hashed_password = md5($contraseña);

    // Verificar si el usuario o el correo ya existen
    $check_query = "SELECT * FROM usuarios WHERE USUARIO = '$usuario'";
    $result = $conexion->query($check_query);

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El usuario ya existe.']);
    } else {
        // Consulta SQL para insertar el nuevo usuario
        $query = "INSERT INTO usuarios (USUARIO, CORREO, NOMBRE, TIENDA, ROLL, CONTRASEÑA) 
                  VALUES ('$usuario', '$correo', '$nombre', '$tienda', '$rol', '$hashed_password')";

        if ($conexion->query($query) === TRUE) {
            echo "Usuario creado correctamente";
        } else {
            echo "Error al crear usuario: " . $conexion->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
