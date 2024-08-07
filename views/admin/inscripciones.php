<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../index.html");
}

$nombre = $_SESSION['admin_nombre'];
$ap_paterno = $_SESSION['admin_ap_paterno'];
$nombre_completo = $nombre . " " . $ap_paterno;

// Conectar a la base de datos
require_once '../../connection/conn.php';

// Recuperar inscripciones
$sql = "SELECT i.id_inscripcion, CONCAT(c.nombre, ' ', c.ap_paterno, ' ', c.ap_materno) AS nombre_completo, 
        tm.tipo_membresia, i.fecha_inicio, i.fecha_fin, e.estatus AS estatus, i.pago 
        FROM tb_inscripciones i 
        JOIN tb_clientes c ON i.id_cliente = c.id_cliente 
        JOIN tb_tipo_membresias tm ON i.id_tipo_membresia = tm.id_tipo_membresia
        JOIN tb_estatus e ON i.id_estatus = e.id_estatus";

$result = $conn->query($sql);
$inscripciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inscripciones[] = $row;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="es">
<head>
    <title>Inscripciones | Syntax Strong</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../assets/css/admin_css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin_css/usuarios.css">
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es_es.json"
            }
        });

        // Eliminar inscripción
        $('.btn-eliminar').click(function() {
            var id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar esta inscripción?')) {
                $.post('../../connection/admin/delete_inscripcion.php', {id_inscripcion: id}, function(response) {
                    if (response === 'success') {
                        alert('Inscripción eliminada correctamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar la inscripción');
                    }
                });
            }
        });

        // Actualizar inscripción
        $('.btn-actualizar').click(function() {
            var id = $(this).data('id');
            // Aquí puedes agregar lógica para obtener los nuevos valores de actualización, por ejemplo usando un formulario modal
            var fecha_inicio = prompt('Nueva fecha de inicio (YYYY-MM-DD):');
            var fecha_fin = prompt('Nueva fecha de fin (YYYY-MM-DD):');
            var id_estatus = prompt('Nuevo estatus (ID):');
            var pago = prompt('Nuevo pago:');
            
            if (fecha_inicio && fecha_fin && id_estatus && pago) {
                $.post('../../connection/admin/update_inscripcion.php', {
                    id_inscripcion: id,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                    id_estatus: id_estatus,
                    pago: pago
                }, function(response) {
                    if (response === 'success') {
                        alert('Inscripción actualizada correctamente');
                        location.reload();
                    } else {
                        alert('Error al actualizar la inscripción');
                    }
                });
            } else {
                alert('Por favor, completa todos los campos.');
            }
        });
    });
</script>

<body>
<header>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <img src="../../assets/image/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            <span class="logo-name">Syntax Strong</span>
        </div>
        <div class="saludo">
            <h5><?= $nombre_completo; ?> | Administrador</h5>
        </div>
        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <img src="../../assets/image/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                <span class="logo-name">Syntax Strong</span>
            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="./dashboard.php" class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Dashboard</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./ganancias.php" class="nav-link">
                            <i class="bx bx-bell icon"></i>
                            <span class="link">Ganancias al mes</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./usuarios.php" class="nav-link">
                            <i class='bx bx-user-check icon'></i>
                            <span class="link">Usuarios</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./inscripciones.php" class="nav-link">
                            <i class='bx bx-notepad icon'></i>
                            <span class="link">Inscripciones</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="../../connection/logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="contenido-general">
    <h1 class="fw-bold text-center p-2">Inscripciones</h1>
    <div class="tabla_usuarios">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th>Membresía</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th>Estatus</th>
                    <th>Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscripciones as $inscripcion): ?>
                <tr>
                    <td><?= $inscripcion['id_inscripcion'] ?></td>
                    <td><?= $inscripcion['nombre_completo'] ?></td>
                    <td><?= $inscripcion['tipo_membresia'] ?></td>
                    <td><?= $inscripcion['fecha_inicio'] ?></td>
                    <td><?= $inscripcion['fecha_fin'] ?></td>
                    <td><?= $inscripcion['estatus'] ?></td>
                    <td><?= $inscripcion['pago'] ?></td>
                    <td>
                        <button class="btn btn-danger btn-eliminar" data-id="<?= $inscripcion['id_inscripcion'] ?>">Eliminar</button>
                        <button class="btn btn-success btn-actualizar" data-id="<?= $inscripcion['id_inscripcion'] ?>">Actualizar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<footer>
    <!-- place footer here -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="../../assets/js/admin/sidevar.js"></script>
</body>
</html>
