<?php
session_start();

// Verificar si el usuario está autenticado y es de tipo 'Teacher'
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'Teacher') {
    // Incluir el archivo de contacto y crear instancia
    include('../Conexion/contacto.php');
    $contacto = new Contacto();

    // Verificar si se ha enviado el ID del programa mediante POST
    if (isset($_POST['programa_id'])) {
        // Asignar valores de user_id y programa_id antes de llamar a la función
        $user_id = $_SESSION['user_id'];  // ID del usuario de la sesión
        $programa_id = $_POST['programa_id']; // ID del programa enviado por POST

        // Verificar si el usuario ya está inscrito en el programa
        $inscrito = $contacto->verificar_inscripcion($user_id, $programa_id);

        if (!$inscrito) {
            // Inscribir al usuario si no está inscrito
            $contacto->inscribir_usuario_en_programa($user_id, $programa_id);
            echo "success"; // Respuesta en caso de éxito
        } else {
            echo "already_enrolled"; // Respuesta si ya está inscrito
        }
    } else {
        echo "no_program_selected"; // Respuesta si no se envió un programa
    }
} else {
    echo "no_permission"; // Respuesta si el usuario no tiene permisos
}
?>
