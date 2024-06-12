<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
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
<?php

include 'database.php';
// Verificar si se ha enviado un ID de usuario válido en la URL
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idUsuario = $_GET['id'];
   
    $query = "SELECT * FROM usuarios WHERE IDUSUARIO = '".$idUsuario."'";
    $result = $conexion->query($query);

    // Verificar si se encontró un usuario con ese ID
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        die("Usuario no encontrado");
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    die("ID de usuario no válido");
}
?>

<form id="editar-form" action="guardarUsuario.php" method="POST">
    <h2>Editar Usuario</h2>
    <input type="hidden" name="IDUSUARIO" value="<?php echo $usuario['IDUSUARIO']; ?>">
    Usuario: <input type="text" name="USUARIO" value="<?php echo $usuario['USUARIO']; ?>"><br>
    Nombre: <input type="text" name="NOMBRE" value="<?php echo $usuario['NOMBRE']; ?>"><br>
    Correo: <input type="text" name="CORREO" value="<?php echo $usuario['CORREO']; ?>"><br>
    Tienda: <input type="text" name="TIENDA" value="<?php echo $usuario['TIENDA']; ?>"><br>
    Rol: <input type="text" name="ROLL" value="<?php echo $usuario['ROLL']; ?>"><br>
    <button type="submit">Actualizar</button>
</form>

<script>
    
    $(document).ready(function() {
        $('#crear-form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'guardarNuevoUsuario.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        window.location.href = 'listaUsuarios.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al crear usuario:', status, error);
                }
            });
        });
    });


</script>
