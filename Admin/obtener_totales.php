<?php
require_once '../Conexion/contacto.php';

$obj = new Contacto();

$totalUsuarios = $obj->contarUsuarios(); // Función que cuenta los usuarios
$totalProgramas = $obj->contarProgramas(); // Función que cuenta los programas
$totalMaterias = $obj->contarMaterias(); // Función que cuenta las materias

echo json_encode([
    'usuarios' => $totalUsuarios,
    'programas' => $totalProgramas,
    'materias' => $totalMaterias,
]);
?>