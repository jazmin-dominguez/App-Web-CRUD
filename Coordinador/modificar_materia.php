<?php
// Incluir la conexión a la base de datos y la clase Contacto
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar y sanitizar los datos recibidos
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre_materia = isset($_POST['nombre_materia']) ? trim($_POST['nombre_materia']) : '';
    $objetivos = isset($_POST['objetivos']) ? trim($_POST['objetivos']) : '';
    $actividades = isset($_POST['actividades']) ? intval($_POST['actividades']) : 0;
    
    // Verificar que todos los datos requeridos están presentes
    if ($id && $nombre_materia && $objetivos && $actividades && $actividades) {
        $obj = new Contacto();

        // Llamar a la función de modificación del programa
        $resultado = $obj->modificar_materia($id, $nombre_materia, $objetivos, $actividades);

        if ($resultado) {
            echo "Subject updated successfully";
        } else {
            http_response_code(500);
            echo "Error updating subject";
        }
    } else {
        http_response_code(400);
        echo "Missing or invalid data";
    }
}
?>