<?php 
include './connection/conn.php';
// Captura de datos para el registro del cliente a la BD

// Verificación del form de registro enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $fecha_na = $_POST['fecha_na'];
    $num_celular = $_POST['num_celular'];
    $sexo = $_POST['sexo'];

    // Insertando en la tabla de clientes los capturados en la BD
    $query = "INSERT INTO tb_clientes (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo) 
              VALUES ('$nombre', '$ap_paterno', '$ap_materno', '$curp', '$fecha_na', '$num_celular', '$sexo')";

    if ($conexion->query($query) === TRUE) {
        $id_cliente = $conexion->insert_id;
        // Redireccionamiento a la vista del tipo de membresía
        header("Location: seleccionar_membresia.php?id_cliente=$id_cliente");
        exit();
        // Depuracion en caso de errores por query
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
}
