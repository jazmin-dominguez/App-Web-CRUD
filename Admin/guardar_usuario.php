<?php
require_once '../Conexion/contacto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si se reciben todos los datos necesarios
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['genero']) &&
        isset($_POST['tipo_usuario']) && isset($_POST['fecha_nac']) && isset($_POST['edad'])) {

        // Recoge los datos enviados por el formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $genero = $_POST['genero'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $fecha_nac = $_POST['fecha_nac'];
        $edad = $_POST['edad'];

        // Instancia el objeto de contacto
        $obj = new Contacto();

        // Llama a la función para actualizar el usuario
        $resultado = $obj->modificar_usuario($id, $nombre, $correo, $genero, $edad, $tipo_usuario, $fecha_nac);

        // Verifica si la actualización fue exitosa
        if ($resultado) {
            echo "User updated successfully";
        } else {
            echo "Error updating user";
        }
    } else {
        echo "Missing data for updating user";
    }
}
?>
