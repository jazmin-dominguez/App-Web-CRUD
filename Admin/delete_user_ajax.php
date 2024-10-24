<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();

if (isset($_POST['id_eliminar'])) {
    $id = $_POST['id_eliminar'];
    
    if ($obj->eliminar_usuario($id)) {
        // Return a success response
        echo "User successfully deleted";
    } else {
        // Handle error
        echo "Error deleting user.";
    }
}
?>
