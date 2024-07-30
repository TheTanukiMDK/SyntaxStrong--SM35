<?php
require_once '../conn.php';

header('Content-Type: application/json');

$sql = "SELECT id_tipo_membresia, tipo_membresia, precio FROM tb_tipo_membresias";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $membresias = [];
    while ($row = $result->fetch_assoc()) {
        $membresias[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $membresias]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron membresías']);
}

$conn->close();
?>
