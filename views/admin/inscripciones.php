<?php 

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: ../../index.html");
}

$nombre = $_SESSION['admin_nombre'];
$ap_paterno = $_SESSION['admin_ap_paterno'];

$nombre_completo = $nombre . " " . $ap_paterno;
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Inscripciones | Syntax Strong</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
            
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/css/admin_css/dashboard.css">
        <link rel="stylesheet" href="../../assets/css/admin_css/usuarios.css">
        <link rel="stylesheet" href="../../connection/admin/enviarInscripciones.js">
        <!-- Favicon -->
        <link rel="shortcut icon" href="../../assets/image/favicon.ico"
            type="image/x-icon">
        <!-- Material Icons -->
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
            rel="stylesheet" />
    </head>

    <body>
    <header>
            <!-- Navbar -->
            <nav>
                <div class="logo">
                    <i class="bx bx-menu menu-icon"></i>
                    <img src="../../assets/image/logo.png" alt="Logo" width="30"
                        height="30"
                        class="d-inline-block align-text-top">
                    <span class="logo-name">Syntax Strong</span>
                </div>
                <div class="saludo">
                    <h5><?= $nombre_completo; ?> | Administrador</h5>
                </div>
                <div class="sidebar">
                    <div class="logo">
                        <i class="bx bx-menu menu-icon"></i>
                        <img src="../../assets/image/logo.png" alt="Logo"
                            width="30" height="30"
                            class="d-inline-block align-text-top">
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
                                <a href="./usuarios.php"
                                    class="nav-link">
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
                        </div>
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
                            <th>id</th>
                            <th>Nombre completo</th>
                            <th>Membresia</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Estatus</th>
                            <th>Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Ricardo</td>
                            <td>Premium</td>
                            <td>20/07/2024</td>
                            <td>20/08/2024</td>
                            <td>Activo</td>
                            <td>Pagado</td>
                            <td>
                                <button class="btn btn-danger">Eliminar</button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal">Actualizar</button>
                                <!-- Modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="updateForm" method="post" action="../../connection/admin/inscripCion.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Actualizar Membresía</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id" value="">
                            <div class="mb-3">
                                <label for="membership" class="form-label">Membresía</label>
                                <select class="form-select" id="membership" name="membership">
                                    <option value="Basic">Basic</option>
                                    <option value="Premium">Premium</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duración (meses)</label>
                        <input type="number" class="form-control" id="duration" name="duration" min="1" value="1">
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
        <!-- Script JS -->
        <script src="../../assets/js/admin/sidevar.js"></script>
    </body>
</html>


