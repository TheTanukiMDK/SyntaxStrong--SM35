<?php
$host = 'mysql-tanukistyles.alwaysdata.net';
$user = '368585';
$pass = '46154774'; 
$db = 'tanukistyles_gym';

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa";