<?php 
include './connection/conn.php';

$id_usuario = $_POST['id_usuario'];
$tipo_membresia = $_POST['tipo_membresia'];
$duracion = $_POST['duracion'];

// Obtener el precio de la membresía seleccionada
$query_precio = "SELECT precio FROM tb_membresia WHERE tipo_membresia = '$tipo_membresia'";

$result_precio = $conexion->query($query_precio);
$row_precio = $result_precio->fetch_assoc();
$precio_mensual = $row_precio['precio'];

// Calcular el costo total basado en la duración
$costo_total = $precio_mensual * $duracion;

// Insertar la membresía en la base de datos
$fecha_inicio = date("Y-m-d H:i:s");
$fecha_fin = date("Y-m-d H:i:s", strtotime("+$duracion months"));

// Obtener el id del estatus 'activo'
$query_estatus = "SELECT id_estatus FROM tb_estatus WHERE estatus = 'activo'";
$result_estatus = $conexion->query($query_estatus);
$row_estatus = $result_estatus->fetch_assoc();
$id_estatus = $row_estatus['id_estatus'];

$query = "INSERT INTO tb_inscripcion (id_usuario, id_membresia, fecha_inicio, fecha_fin, id_estatus) 
    VALUES ('$id_usuario', 
        (SELECT id_membresia FROM tb_membresia WHERE tipo_membresia = '$tipo_membresia'), 
        '$fecha_inicio', '$fecha_fin', '$id_estatus')";

// Insertar una nueva inscripción y actualizar el estatus del usuario
$query = "INSERT INTO tb_inscripcion (id_usuario, id_membresia, fecha_inicio, fecha_fin, id_estatus) 
          VALUES ('$id_usuario', 
                  (SELECT id_membresia FROM tb_membresia WHERE tipo_membresia = '$tipo_membresia'), 
                  '$fecha_inicio', '$fecha_fin', '$id_estatus_activo')
          ON DUPLICATE KEY UPDATE
          id_membresia = VALUES(id_membresia),
          fecha_inicio = VALUES(fecha_inicio),
          fecha_fin = VALUES(fecha_fin),
          id_estatus = VALUES(id_estatus)";

if ($conexion->query($query) === TRUE) {
    echo "Membresía registrada exitosamente. Costo total: $$costo_total";
} else {
    echo "Error: " . $query . "<br>" . $conexion->error;
}

header('Location: ./views/admin/dashboard.html');
?>


<?php 




// Obtener el id del estatus 'activo'


// Cerrar la conexión
$conexion->close();
?>