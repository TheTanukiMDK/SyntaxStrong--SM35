//add_cliente.php
<?php
require_once '../conn.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $fecha_na = $_POST['fecha_na'];
    $num_celular = $_POST['num_celular'];
    $sexo = $_POST['sexo'];

    $sql = "INSERT INTO tb_clientes (nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo) 
            VALUES ('$nombre', '$ap_paterno', '$ap_materno', '$curp', '$fecha_na', '$num_celular', '$sexo')";

    if ($conn->query($sql) === TRUE) {
        $id_cliente = $conn->insert_id;
        echo json_encode(['success' => true, 'id_cliente' => $id_cliente]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido']);
}

$conn->close();
?>
