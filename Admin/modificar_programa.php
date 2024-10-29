<?php
// Incluir la conexión a la base de datos y la clase Contacto
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar y sanitizar los datos recibidos
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $programa_nombre = isset($_POST['programa_nombre']) ? trim($_POST['programa_nombre']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $materia = isset($_POST['materia']) ? intval($_POST['materia']) : 0;
    $tipo_usuario = isset($_POST['tipo_usuario']) ? intval($_POST['tipo_usuario']) : 0;

    // Verificar que todos los datos requeridos están presentes
    if ($id && $programa_nombre && $descripcion && $materia && $tipo_usuario) {
        $obj = new Contacto();

        // Llamar a la función de modificación del programa
        $resultado = $obj->modificar_programa($id, $programa_nombre, $descripcion, $materia, $tipo_usuario);

        if ($resultado) {
            echo "Program updated successfully";
        } else {
            http_response_code(500);
            echo "Error updating program";
        }
    } else {
        http_response_code(400);
        echo "Missing or invalid data";
    }
}


?>

