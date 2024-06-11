
      $(document).ready(function() {
        $.ajax({
            url: 'getUsers.php',
            type: 'GET',
            success: function(response) {
                var tbody = $('#user-table-body');
                tbody.empty(); // Limpiar tabla antes de agregar nuevos datos
                $.each(response, function(index, usuario) {
                    var row = '<tr>' +
                        '<td>' + usuario.IDUSUARIO + '</td>' +
                        '<td>' + usuario.USUARIO + '</td>' +
                        '<td>' + usuario.NOMBRE + '</td>' +
                        '<td>' + usuario.CORREO + '</td>' +
                        '<td>' + usuario.TIENDA + '</td>' +
                        '<td>' + usuario.ROLL + '</td>' +
                        '<td>' +
                        '<button onclick="editarUsuario(' + usuario.IDUSUARIO + ')">Editar</button>' +
                        '<button onclick="inhabilitarUsuario(' + usuario.IDUSUARIO + ')">Inhabilitar</button>' +
                        '</td>' +
                        '</tr>';
                    tbody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener usuarios:', status, error);
            }
        })
    });

