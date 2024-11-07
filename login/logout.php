<?php
session_start();
include('../Conexion/contacto.php'); // Asegúrate de incluir el archivo correcto
$obj = new Contacto();

if (isset($_SESSION['user_id'])) {
    $obj->sentencia = "UPDATE usuarios SET session_activa = 0 WHERE id = " . $_SESSION['user_id'];
    $obj->ejecutar_sentencia();
}

// Destruir la sesión
session_destroy();

// Redireccionar al inicio de sesión u otra página
header("location: ../index.php");
exit();
