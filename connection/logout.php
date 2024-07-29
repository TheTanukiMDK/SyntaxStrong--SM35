<?php
session_start();
require_once './conn.php';

if (isset($_SESSION['admin_id'])) {
    $id_admin = $_SESSION['admin_id'];

    // Actualizar estado a 'inactivo'
    $sql = "UPDATE tb_admin SET estado = 'inactivo' WHERE id_admin = $id_admin";
    $conn->query($sql);

    // Destruir la sesión
    session_destroy();

    // Redireccionar a la página de login
    header("Location: ../index.html");
} else {
    header("Location: ../index.html");
}

$conn->close();
