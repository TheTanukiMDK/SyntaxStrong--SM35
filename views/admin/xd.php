<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../index.html");
    exit();
}

$nombre = $_SESSION['admin_nombre'];
$ap_paterno = $_SESSION['admin_ap_paterno'];

$nombre_completo = $nombre . " " . $ap_paterno;
?>
<!doctype html>
<html lang="es">
<head>
    <title>Gestión de usuarios | Syntax Strong</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../assets/css/admin_css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin_css/usuarios.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="../../assets/image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <style>
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
            color: #212529;
        }
        .dataTables_wrapper .dataTables_length select, .dataTables_wrapper .dataTables_filter input {
            color: #212529;
        }
        .table-hover tbody tr:hover {
            background-color: #343a40 !important;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <img src="../../assets/image/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                <span class="logo-name">Syntax Strong</span>
            </div>
            <div class="saludo">
                <h5><?= htmlspecialchars($nombre_completo); ?> | Administrador</h5>
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
        <h1 class="fw-bold text-center p-2">Todos los usuarios</h1>

        <!-- Botón para abrir el modal -->
        <div class="text-center mb-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClientModal">
                Añadir Cliente
            </button>
        </div>

        <!-- Modal para añadir un nuevo cliente -->
        <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClientModalLabel">Registrar nuevo cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addClientForm" action="../../connection/admin/add_cliente.php" method="post">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" required>
                            </div>
                            <div class="mb-3">
                                <label for="ap_materno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="ap_materno" name="ap_materno" required>
                            </div>
                            <div class="mb-3">
                                <label for="curp" class="form-label">CURP</label>
                                <input type="text" class="form-control" id="curp" name="curp" maxlength="18" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_na" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_na" name="fecha_na" required>
                            </div>
                            <div class="mb-3">
                                <label for="num_celular" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="num_celular" name="num_celular" maxlength="10" required>
                            </div>
                            <div class="mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para seleccionar tipo de membresía -->
        <div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membershipModalLabel">Seleccionar Membresía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="membershipForm" action="../../connection/admin/add_membresia.php" method="post">
                    <input type="hidden" id="id_cliente_membresia" name="id_cliente">
                    <div class="mb-3">
                        <label for="tipo_membresia" class="form-label">Tipo de Membresía</label>
                        <select class="form-control" id="tipo_membresia" name="tipo_membresia" required>
                        <?php
            include '../../connection/conn.php';

            $consulta = "SELECT * FROM tb_tipo_membresias";
            $query = mysqli_query($conn, $consulta);

            while ($fila = mysqli_fetch_array($query)) {
                ?>
                <option value="<?php echo $fila['id_tipo_membresia']; ?>" data-precio="<?php echo $fila['precio']; ?>">
                    <?php echo $fila['tipo_membresia']; ?>
                </option>
            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="text" class="form-control" id="costo" name="costo" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <input type="text" class="form-control" id="estatus" name="estatus" value="Activo" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Pagar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('tipo_membresia').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var precio = selectedOption.getAttribute('data-precio');
        document.getElementById('costo').value = precio;
    });
</script>
        <div class="tabla_usuarios table-responsive mt-4">
            <table id="clientesTable" class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>CURP</th>
                        <th>Fecha de nacimiento</th>
                        <th>Teléfono</th>
                        <th>Sexo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../connection/conn.php';

                    $sql = "SELECT id_cliente, CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre_completo, curp, fecha_na, num_celular, sexo FROM tb_clientes ORDER BY id_cliente DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_cliente = $row['id_cliente'];
                            
                            // Consulta para verificar si el cliente está inscrito
                            $sql_inscripcion = "SELECT * FROM tb_inscripciones WHERE id_cliente = ? AND id_estatus = '1'";
                            $stmt = $conn->prepare($sql_inscripcion);
                            $stmt->bind_param("i", $id_cliente);
                            $stmt->execute();
                            $resultado_inscripcion = $stmt->get_result();
                            $esta_inscrito = $resultado_inscripcion->num_rows > 0;
                    
                            $stmt->close();
                    
                            echo "<tr>";
                            echo "<td>" . $row['id_cliente'] . "</td>";
                            echo "<td>" . $row['nombre_completo'] . "</td>";
                            echo "<td>" . $row['curp'] . "</td>";
                            echo "<td>" . $row['fecha_na'] . "</td>";
                            echo "<td>" . $row['num_celular'] . "</td>";
                            echo "<td>" . $row['sexo'] . "</td>";
                            echo '<td>';
                            echo '<button class="btn btn-danger btn-sm" onclick="eliminarCliente(' . $row['id_cliente'] . ')"><i class="bi bi-trash"></i></button>';
                            echo '<button class="btn btn-success btn-sm" onclick="actualizarCliente(' . $row['id_cliente'] . ')"><i class="bi bi-pencil"></i></button>';
                            
                            // Mostrar el botón solo si el cliente no está inscrito
                            if (!$esta_inscrito) {
                                echo '<button class="btn btn-info btn-sm" onclick="mostrarInscripcion(' . $row['id_cliente'] . ')"><i class="bi bi-journal-plus"></i></button>';
                            }
                            
                            echo '</td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No hay usuarios registrados</td></tr>";
                    }
                    
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        
    </footer>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="../../assets/js/admin/sidevar.js"></script>
    <script src="../../assets/js/admin/add_c&m.js"></script>
</body>
</html>