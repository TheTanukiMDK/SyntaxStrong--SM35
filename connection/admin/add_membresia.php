<?php
require_once '../conn.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_tipo_membresia = $_POST['tipo_membresia'];
    $costo = $_POST['costo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estatus = $_POST['estatus'];

    $sql = "INSERT INTO tb_inscripciones (id_cliente, id_tipo_membresia, fecha_inicio, fecha_fin, id_estatus, pago) 
            VALUES ('$id_cliente', '$id_tipo_membresia', '$fecha_inicio', '$fecha_fin', (SELECT id_estatus FROM tb_estatus WHERE estatus = '$estatus'), '$costo')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido']);
}

$conn->close();
?>
