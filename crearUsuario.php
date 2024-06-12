<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        form input[type="text"],
        form input[type="password"],
        form button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form id="crear-form" action="guardarNuevoUsuario.php" method="POST">
        <h2>Crear Usuario</h2>
        Usuario: <input type="text" name="USUARIO" required><br>
        Nombre: <input type="text" name="NOMBRE"><br>
        Correo: <input type="text" name="CORREO"><br>
        Tienda: <input type="text" name="TIENDA" required><br>
        Rol: <input type="text" name="ROLL" required><br>
        Contraseña: <input type="password" name="CONTRASEÑA" required><br>
        <button type="submit">Crear</button>
    </form>

    <script>
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
    $check_query = "SELECT * FROM usuarios WHERE USUARIO = '$usuario' OR CORREO = '$correo'";
    $result = $conexion->query($check_query);

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El usuario o el correo ya existen.']);
    } else {
        // Consulta SQL para insertar el nuevo usuario
        $query = "INSERT INTO usuarios (USUARIO, CORREO, NOMBRE, TIENDA, ROLL, CONTRASEÑA) 
                  VALUES ('$usuario', '$correo', '$nombre', '$tienda', '$rol', '$hashed_password')";

        if ($conexion->query($query) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario creado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear usuario: ' . $conexion->error]);
        }
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
    <script>
    $(document).ready(function() {
            $('#crear-form').submit(function(e) {
                e.preventDefault(); // Prevenir el envío por defecto

                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Realizar la solicitud AJAX para guardar el nuevo usuario
                $.ajax({
                    url: 'guardarNuevoUsuario.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response);
                        window.location.href = 'inicio.php#modulo-usuarios';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al crear usuario:', status, error);
                    }
                });
            });
        });
    </script>
</body>
</html>
