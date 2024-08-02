<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../index.html");
    exit();
}

require_once '../../connection/conn.php';

if (isset($_POST['id_inscripcion'])) {
    $id_inscripcion = $_POST['id_inscripcion'];

    // Registrar la acción antes de eliminar
    $sql_log = "INSERT INTO tb_inscripciones_log (id_inscripcion, id_cliente, id_tipo_membresia, tipo_membresia, fecha_inicio, fecha_fin, id_estatus, pago, accion, usuario)
                SELECT id_inscripcion, id_cliente, id_tipo_membresia, tipo_membresia, fecha_inicio, fecha_fin, id_estatus, pago, 'DELETE', '{$_SESSION['admin_nombre']}' 
                FROM tb_inscripciones WHERE id_inscripcion = $id_inscripcion";
    if ($conn->query($sql_log) === TRUE) {
        echo "";
    } else {
        echo "Error al insertar el log: " . $conn->error;
    }

    // Eliminar la inscripción
    $sql = "DELETE FROM tb_inscripciones WHERE id_inscripcion = $id_inscripcion";
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "¡Inscripción eliminada correctamente!";
        } else {
            echo "No se encontró la inscripción para eliminar.";
        }
    } else {
        echo "Error al eliminar la inscripción: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No se proporcionó id_inscripcion";
}
?>
