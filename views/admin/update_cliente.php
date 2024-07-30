//update_cliente.php
<?php
require_once '../../connection/conn.php';

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Consulta para obtener los datos del cliente
    $sql = "SELECT * FROM tb_clientes WHERE id_cliente = $id_cliente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Actualizar Cliente</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <h2>Actualizar Cliente</h2>
            <form action="../../connection/admin/update_cliente.php" method="post" class="form-control">
                <input type="hidden" name="id_cliente" value="<?php echo $row['id_cliente']; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control"><br>
                Apellido Paterno: <input type="text" name="ap_paterno" value="<?php echo $row['ap_paterno']; ?>" class="form-control"><br>
                Apellido Materno: <input type="text" name="ap_materno" value="<?php echo $row['ap_materno']; ?>" class="form-control"><br>
                CURP: <input type="text" name="curp" value="<?php echo $row['curp']; ?>" class="form-control"><br>
                Fecha de Nacimiento: <input type="date" name="fecha_na" value="<?php echo $row['fecha_na']; ?>" class="form-control"><br>
                Teléfono: <input type="text" name="num_celular" value="<?php echo $row['num_celular']; ?>" class="form-control"><br>
                Sexo: 
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="femenino" <?php if ($row['sexo'] == 'femenino') echo 'selected'; ?>>Femenino</option>
                    <option value="masculino" <?php if ($row['sexo'] == 'masculino') echo 'selected'; ?>>Masculino</option>
                </select><br>
                <input type="submit" value="Actualizar" class="btn btn-primary">
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "Cliente no encontrado.";
    }
} else {
    echo "ID de cliente no especificado.";
}

$conn->close();
?>