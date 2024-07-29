<?php 
include './connection/conn.php';
// Captura de datos para el registro del cliente

// Verificación del form enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de los datos del form
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $fecha_na = $_POST['fecha_na'];
    $num_celular = $_POST['num_celular'];
    $sexo = $_POST['sexo'];

    // Consulta para el insert a la tabla tb_clientes
    $query = "INSERT INTO tb_clientes (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo) 
              VALUES ('$nombre', '$ap_paterno', '$ap_materno', '$curp', '$fecha_na', '$num_celular', '$sexo')";

    // Ejecutando la consulta
    if ($conexion->query($query) === TRUE) {
        // Redirige al usuario a la vista de tipo de membresía
        header('Location: ./views/register/register_m.html');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
}
