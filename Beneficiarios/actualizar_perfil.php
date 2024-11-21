<?php
session_start();
require_once '../Conexion/contacto.php';

$obj = new Contacto();
$usuario_id = $_SESSION['user_id']; // Asegúrate de que este dato esté en la sesión

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$fecha_nac = $_POST['fecha_nac'];
$genero = $_POST['genero'];

// Calcular la edad
$fecha_actual = new DateTime();
$fecha_nacimiento = new DateTime($fecha_nac);
$edad = $fecha_actual->diff($fecha_nacimiento)->y;

// Actualizar los datos del usuario
$resultado_actualizacion = $obj->actualizar_usuario($usuario_id, $nombre, $correo, $fecha_nac, $genero, $edad);

if ($resultado_actualizacion) {
    $_SESSION['nombre'] = $nombre;
    $_SESSION['correo'] = $correo;
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'Error']);
}
?>
