<?php
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = new Contacto(); // Instanciar el objeto de la clase Contacto
    $id = $_POST['id'];    // Obtener el ID del programa a eliminar

    if ($obj->eliminar_programa($id)) { // Llamar al método específico para eliminar programas
        echo "Program deleted successfully";
    } else {
        echo "Error deleting program";
    }
} else {
    echo "Invalid request method";
}
?>
