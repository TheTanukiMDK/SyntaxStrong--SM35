<?php 
include './connection/conn.php';

print_r($_POST);

$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$curp = $_POST['curp'];
$fecha_na = $_POST['fecha_na'];
$num_celular = $_POST['num_celular'];
$sexo = $_POST['sexo'];

$query = "INSERT INTO clientes(nombre, ap_paterno, ap_materno, curp, fecha_na, num_celular, sexo) 
VALUE ('$nombre','$ap_paterno','$ap_materno','$curp','$fecha_na','$num_celular','$sexo')";

$insert = $conexion->query($query);

header('Location: ./views/register/register.html');