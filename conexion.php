<?php

$server = "localhost";
$username = "root";
$password = ""; 
$database = "db"; 


$con = mysqli_connect($server, $username, $password, $database);

// Verificar la conexión
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
