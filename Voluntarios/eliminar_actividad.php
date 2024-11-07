<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $obj->eliminar_actividad($id);
    
    echo $result ? "success" : "error";
}
?>
