<?php
session_start();

// Verificar si el usuario está autenticado y es de tipo 'Teacher'
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'Student') {
    include('../Conexion/contacto.php');
    $contacto = new Contacto();

    // Verificar si se ha enviado el ID de la materia mediante POST
    if (isset($_POST['materia_id'])) {
        $user_id = $_SESSION['user_id'];
        $materia_id = $_POST['materia_id'];

        // Verificar si el usuario ya está inscrito en la materia
        $inscrito = $contacto->verificar_inscripcion_materia($user_id, $materia_id);

        if (!$inscrito) {
            // Inscribir al usuario si no está inscrito
            $contacto->inscribir_usuario_en_materia($user_id, $materia_id);
            echo "success";
        } else {
            echo "already_enrolled";
        }
    } else {
        echo "no_materia_selected";
    }
} else {
    echo "no_permission";
}
?>
