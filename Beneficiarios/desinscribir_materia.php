<?php
session_start();

require_once('../Conexion/contacto.php');

$obj = new Contacto();

// Verificar si se recibieron los parámetros necesarios
if (isset($_POST['materia_id']) && isset($_SESSION['user_id'])) {
    $materia_id = intval($_POST['materia_id']);
    $user_id = intval($_SESSION['user_id']);

    // Llamar a la función desinscribir_materia
    $resultado = $obj->desinscribir_materia($user_id, $materia_id);

    if ($resultado) {
        echo "success"; // Inscripción eliminada correctamente
    } else {
        echo "error"; // Error al eliminar la inscripción
    }
} else {
    echo "error"; // Parámetros no válidos
}
