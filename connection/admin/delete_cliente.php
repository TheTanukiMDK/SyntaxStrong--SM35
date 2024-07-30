// delete_cliente.php
<?php
require_once '../../connection/conn.php';

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $sql = "DELETE FROM tb_clientes WHERE id_cliente = $id_cliente";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../views/admin/usuarios.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID de cliente no especificado.";
}

$conn->close();
?>
