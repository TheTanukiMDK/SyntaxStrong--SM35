<?php 

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: ../../index.html");
}

$nombre = $_SESSION['admin_nombre'];
$ap_paterno = $_SESSION['admin_ap_paterno'];

$nombre_completo = $nombre . " " . $ap_paterno;

//logica para obtener el total de venta de las membresias
include '../../connection/conn.php';
$id_tipo_membresia_clasic = 1; // Cambia esto según el ID de la membresía Clasic
$id_tipo_membresia_premium = 2; // Cambia esto según el ID de la membresía Premium
$id_tipo_membresia_senior = 3; // Cambia esto según el ID de la membresía Senior

$sql_clasic = "SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = '$id_tipo_membresia_clasic'";
$sql_premium = "SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = '$id_tipo_membresia_premium'";
$sql_senior = "SELECT SUM(pago) AS total_venta FROM tb_inscripciones WHERE id_tipo_membresia = '$id_tipo_membresia_senior'";

$result_clasic = $conn->query($sql_clasic);
$result_premium = $conn->query($sql_premium);
$result_senior = $conn->query($sql_senior);

$total_venta_clasic = $result_clasic->fetch_assoc()['total_venta'];
$total_venta_premium = $result_premium->fetch_assoc()['total_venta'];
$total_venta_senior = $result_senior->fetch_assoc()['total_venta'];

//logica para el total de clientes 
//$id_cliente = $_GET['id_cliente'];

$sql_total_clientes = "SELECT count(*) AS total_clientes FROM tb_clientes";
$sql_total_hombres = "SELECT count(*) AS total_hombres FROM tb_clientes WHERE sexo = 'masculino'";
$sq_total_mujeres = "SELECT count(*) AS total_mujeres FROM tb_clientes WHERE sexo = 'femenino'";

$result_total_clientes = $conn->query($sql_total_clientes);
$result_total_hombres = $conn->query($sql_total_hombres);
$result_total_mujeres = $conn->query($sq_total_mujeres);

$total_clientes = $result_total_clientes->fetch_assoc()['total_clientes'];
$total_hombres = $result_total_hombres->fetch_assoc()['total_hombres'];
$total_mujeres = $result_total_mujeres->fetch_assoc()['total_mujeres'];

//logica para el total de las inscripciones

//$id_inscripcion = $_GET['id_inscripcion'];
$sql_total_inscritos = "SELECT count(*) AS total_inscritos FROM tb_inscripciones";
$sql_total_activos = "SELECT count(*) AS total_activos FROM tb_inscripciones WHERE id_estatus = 1";

$result_total_inscritos = $conn->query($sql_total_inscritos);
$result_total_activos = $conn->query($sql_total_activos);

$total_inscritos = $result_total_inscritos->fetch_assoc()['total_inscritos'];
$total_activos = $result_total_activos->fetch_assoc()['total_activos'];
$conn->close();

?>
<!doctype html>
<html lang="es">
    <head>
        <title>Inicio | Syntax Strong</title>
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
            <h1 class="fw-bold text-center ">Dashboard</h1>
            <h2 class="fw-semibold text-center p-2" style="color: #FF810E">Total
                de membresias Vendidas </h2>
            <div class="contenido_datos">
                <div class="total_membresias">

                    <div class="card_datos">
                        <h3 class="fw-bold text-center">Clasic</h3>
                        <div>
                            <h4 class="text-center">Total venta</h4>
                            <p class="text-center">$<?= number_format($total_venta_clasic) ?></p>
                        </div>
                    </div>

                    <div class="card_datos">
                        <h3 class="fw-bold text-center">Premiun</h3>
                        <div>
                            <h4 class="text-center">Total venta</h4>
                            <p class="text-center">$<?= number_format($total_venta_premium) ?></p>
                        </div>
                    </div>

                    <div class="card_datos">
                        <h3 class="fw-bold text-center">Senior</h3>
                        <div>
                            <h4 class="text-center">Total venta</h4>
                            <p class="text-center">$<?= number_format($total_venta_senior) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="usuarios_datos">
                <h3 class="fw-semibold text-center p-3"
                    style="color: #FF810E">Usuarios Registrados</h3>
<div class="agrupaciones">
    <div class="card_datos_grande">
        <div class="datos_usuarios">
            <div class="datos_1">
                <h4 class="fw-semibold text-center">Total de usuarios</h4>
                <p class="text-center"><?= number_format($total_clientes) ?></p>
            </div>
            <div class="datos_1">
                <h4 class="fw-semibold text-center">Hombres</h4>
                <p class="text-center"> <?= number_format($total_hombres) ?></p>
            </div>

            <div class="datos_1">
                <h4 class="fw-semibold text-center">Mujeres</h4>
                <p class="text-center"><?= number_format($total_mujeres) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="inscristos_usuarios">
    <h3 class="fw-semibold text-center p-3"
    style="color: #FF810E">Usuarios Inscritos</h3>

    <div class="card_datos_inscripciones">
        <div class="card_datos">
            <h3 class="fw-bold text-center">Total de usuarios</h3>
            <div>
                <h4 class="text-center">Total usuarios</h4>
                <p class="text-center"><?= number_format($total_inscritos) ?></p>
            </div>
        </div>

        <div class="card_datos">
            <h3 class="fw-bold text-center">Activos</h3>
            <div>
                <h4 class="text-center">Total usuarios</h4>
                <p class="text-center"><?= number_format($total_activos) ?></p>
            </div>
        </div>

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
