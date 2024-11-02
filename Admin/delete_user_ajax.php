<?php
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = new Contacto();
    $id = $_POST['id'];

    if ($obj->eliminar_usuario($id)) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user";
    }
} else {
    echo "Invalid request method";
}
?>
