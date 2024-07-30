// update_cliente.php
<?php
require_once '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $curp = $_POST['curp'];
    $fecha_na = $_POST['fecha_na'];
    $num_celular = $_POST['num_celular'];
    $sexo = $_POST['sexo'];

    $sql = "UPDATE tb_clientes SET 
                nombre = '$nombre', 
                ap_paterno = '$ap_paterno', 
                ap_materno = '$ap_materno', 
                curp = '$curp', 
                fecha_na = '$fecha_na', 
                num_celular = '$num_celular', 
                sexo = '$sexo' 
            WHERE id_cliente = $id_cliente";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../views/admin/usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
