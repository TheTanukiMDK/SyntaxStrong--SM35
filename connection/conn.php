<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "SintaxStrong";

//$conn = new mysqli($hostname, $username, $password, $database);
$conn = new mysqli($hostname, $username, $password, $database);


if($conn->connect_error){
    die("la conexcion a fallado: " . $conn->connect_error);
}

?>