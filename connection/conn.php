<?php
$host = 'mysql-tanukistyles.alwaysdata.net';
$user = '368585';
$pass = '46154774'; // Asegúrate de que esta es la contraseña correcta
$db = 'tanukistyles_gym';

// Creación de la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificación de la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa";
