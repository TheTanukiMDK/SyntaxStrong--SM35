// add_membresia.php
<?php
require_once '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $tipo_membresia = $_POST['tipo_membresia'];
    $costo = $_POST['costo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estatus = $_POST['estatus'];

    $sql = "INSERT INTO tb_inscripciones (id_cliente, id_tipo_membresia, fecha_inicio, fecha_fin, id_estatus, pago) 
            VALUES ('$id_cliente', '$tipo_membresia', '$fecha_inicio', '$fecha_fin', '$estatus', '$costo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../views/admin/usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
