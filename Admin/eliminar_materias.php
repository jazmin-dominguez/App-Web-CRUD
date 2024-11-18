<?php
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = new Contacto(); // Instanciar el objeto de la clase Contacto
    $id = $_POST['id'];    // Obtener el ID de la materia a eliminar

    if ($obj->eliminar_materia($id)) { // Llamar al método específico para eliminar materias
        echo "Subject deleted successfully";
    } else {
        echo "Error deleting program";
    }
} else {
    echo "Invalid request method";
}
?>
