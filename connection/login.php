<?php
session_start();

if (isset($_POST['correo']) && isset($_POST['contraseña'])) {
    require_once './conn.php';
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    
    // Consulta para verificar las credenciales del administrador
    $sql = "SELECT id_admin, nombre, ap_paterno, ap_materno, estado 
            FROM tb_admin 
            WHERE correo_electronico = '$correo' AND contraseña = '$contraseña'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row['estado'] == 'activo') {
            $_SESSION['error'] = "El usuario ya inició sesión";
            header("Location: ../views/admin/dashboard.php");
            exit();
        }

        // Actualizar estado a 'activo'
        $sql = "UPDATE tb_admin SET estado = 'activo' WHERE id_admin = " . $row['id_admin'];
        $conn->query($sql);

        // Guardar datos del administrador en la sesión
        $_SESSION['admin_id'] = $row['id_admin'];
        $_SESSION['admin_nombre'] = $row['nombre'];
        $_SESSION['admin_ap_paterno'] = $row['ap_paterno'];
        $_SESSION['admin_ap_materno'] = $row['ap_materno'];
        
        header("Location: ../views/admin/dashboard.php");
    } else {
        $_SESSION['error'] = "El correo o la contraseña son incorrectos";
        header("Location: ../index.html");
    }
} else {
    $_SESSION['error'] = "Completa todos los campos";
    header("Location: ../index.html");
}

$conn->close();
