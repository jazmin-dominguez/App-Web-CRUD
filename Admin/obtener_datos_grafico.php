<?php
require_once '../Conexion/contacto.php';

if (isset($_GET['periodo'])) {
    $periodo = $_GET['periodo'];
    $obj = new Contacto();
    $data = $obj->obtenerRegistrosPorPeriodo($periodo);
    echo json_encode($data);
} else {
    echo json_encode([]);
}
?>