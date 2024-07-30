<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../index.html");
    exit();
}

include '../../connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $membership = $_POST['membership'];
    $duration = intval($_POST['duration']);

    // Calcular la fecha de fin y el precio (asumiendo que tienes una lógica para el precio)
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime("+$duration months"));
    $price = 100 * $duration; // Ejemplo: 100 por mes

    $query = "UPDATE users SET membership = ?, start_date = ?, end_date = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssdi', $membership, $startDate, $endDate, $price, $user_id);

    if ($stmt->execute()) {
        echo "Membresía actualizada exitosamente.";
    } else {
        echo "Error al actualizar la membresía: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: inscripciones.php");
    exit();
}
?>