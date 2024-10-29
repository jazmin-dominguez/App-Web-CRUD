<?php
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = new Contacto();
    $id = $_POST['id'];

    if ($obj->eliminar_programa($id)) {
        echo "Program deleted successfully";
    } else {
        echo "Error deleting program";
    }
} else {
    echo "Invalid request method";
}
?>
