<?php
require_once '../../connection/conn.php';

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Eliminar registros relacionados en tb_clientes_logs
    $sql_logs = "DELETE FROM tb_clientes_logs WHERE id_cliente = $id_cliente";
    if ($conn->query($sql_logs) === TRUE) {
        // Consulta para eliminar el cliente
        $sql_cliente = "DELETE FROM tb_clientes WHERE id_cliente = $id_cliente";
        if ($conn->query($sql_cliente) === TRUE) {
            // Redirigir de nuevo a la página de usuarios después de eliminar
            header("Location: ../../views/admin/usuarios.php");
        } else {
            echo "Error al eliminar el cliente: " . $conn->error;
        }
    } else {
        echo "Error al eliminar los registros de log del cliente: " . $conn->error;
    }
} else {
    echo "ID de cliente no especificado.";
}

$conn->close();
?>
