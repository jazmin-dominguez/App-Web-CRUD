<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $obj->eliminar_actividad($id);
    echo "success";
}
?>
