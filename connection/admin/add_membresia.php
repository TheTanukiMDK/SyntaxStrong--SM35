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
    $num_meses = $_POST['num_meses']; // Nuevo campo

    // Para depuración: verifica los valores recibidos
    error_log("Costo recibido: $costo");
    error_log("Número de meses: $num_meses");

    // Puedes eliminar estas líneas después de la depuración
    if ($costo == 0) {
        echo json_encode(['success' => false, 'message' => 'Costo es 0']);
        exit;
    }

    // Calcula la fecha de fin si es necesario
    $fecha_fin_calculada = date('Y-m-d', strtotime("$fecha_inicio + $num_meses months"));

    // Consulta SQL para insertar la inscripción con num_meses
    $sql = "INSERT INTO tb_inscripciones (id_cliente, id_tipo_membresia, fecha_inicio, fecha_fin, id_estatus, pago, num_meses) 
            VALUES ('$id_cliente', '$id_tipo_membresia', '$fecha_inicio', '$fecha_fin_calculada', 
                    (SELECT id_estatus FROM tb_estatus WHERE estatus = '$estatus'), '$costo', '$num_meses')";

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
