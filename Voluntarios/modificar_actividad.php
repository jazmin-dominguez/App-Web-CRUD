<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();

if (isset($_POST['id'], $_POST['nombre_actividad'], $_POST['descripcion'], $_POST['materia'], $_POST['teacher'])) {
    $id = $_POST['id'];
    $nombre_actividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $materia = $_POST['materia'];
    $teacher = $_POST['teacher'];
    
    $obj->modificar_actividad($id, $nombre_actividad, $descripcion, $materia, $teacher);
    echo "success";
}
?>
