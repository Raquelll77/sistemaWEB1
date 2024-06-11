<?php
session_start();
if (!isset($_SESSION['USUARIO'])) {
    header("Location: index.html"); // Redirigir al usuario al inicio de sesión si no ha iniciado sesión
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión del Sistema</title>
    <script src="loadUsers.js" defer></script>
</head>
<body>

<style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover {
            background-color: #575757;
        }

        .sidebar p {
            text-align: center;
        }

        .sidebar p a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .module {
            display: none;
        }

        .module:target {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>

    <div class="sidebar">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['USUARIO']); ?></h2>
        <h2>Menú Principal</h2>
        <ul>
            <li><a href="#modulo-usuarios">Usuarios</a></li>
            <li><a href="#modulo-exportar">Exportar Datos</a></li>
            <li><a href="#modulo-reporte">Reporte Semanal</a></li>
        </ul>
        <p><a href="cerrar_sesion.php">Cerrar sesión</a></p>
    </div>

    <div class="content">
        <div id="modulo-usuarios" class="module">
            <h2>Módulo de Usuarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Tienda</th>
                        <th>Rol</th>
                        <th>Acciones</th> <!-- Nueva columna para acciones -->
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <!-- Ejemplo de un usuario -->
                    <tr>
                        <td>1</td>
                        <td>usuario1</td>
                        <td>Nombre Usuario1</td>
                        <td>correo1@example.com</td>
                        <td>Tienda1</td>
                        <td>Rol1</td>
                        <td>
                            <button onclick="editarUsuario(1)">Editar</button>
                            <button onclick="inhabilitarUsuario(1)">Inhabilitar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="modulo-exportar" class="module">
            <h2>Exportar Datos</h2>
            <form id="export-form">
                <button type="submit">Exportar a CSV</button>
            </form>
        </div>

        <div id="modulo-reporte" class="module">
            <h2>Reporte Semanal</h2>
            <!-- Contenido del reporte semanal -->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>