<?php 
include './connection/conn.php';

print_r($_POST);

$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$curp = $_POST['curp'];
$sexo = $_POST['sexo'];
$num_celular = $_POST['num_celular'];


$query = "INSERT INTO clientes(nombre,ap_paterno,ap_materno,curp,sexo,num_celular) 
VALUE ('$nombre','$ap_paterno','$ap_materno','$curp','$sexo','$num_celular')";

$insert = $conexion->query($query);

header('Location: ./views/register/register.html');
?>



