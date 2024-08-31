<?php

include("conexion.php");


$Matricula = $_POST['matricula'];
$Nombres = $_POST['nombres'];
$Apellidopaterno = $_POST['apellidopaterno'];
$Apellidomaterno = $_POST['apellidomaterno'];
$Correo = $_POST['correo'];
$Edad = $_POST['edad'];
$Contrasena = $_POST['contrasena'];
$Confirmarcontrasena = $_POST['confirmarcontrasena'];

$stmt = $con->prepare("SELECT * FROM beneficiarios WHERE matricula = ? OR correo = LOWER(?)");
$stmt->bind_param("ss", $Matricula, $Correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response = array(
        'status' => 'error',
        'message' => 'El correo y/o la matricula de beneficiario ya están registrados. ¡Inicia Sesión!'
    );
    echo json_encode($response);
    exit();
}


if ($Contrasena !== $Confirmarcontrasena) {
    $response = array(
        'status' => 'error',
        'message' => 'Las contraseñas no coinciden. Por favor, verifica.'
    );
    echo json_encode($response);
    exit();
}


$Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT); 
$stmt = $con->prepare("INSERT INTO beneficiarios (matricula, nombres, apellidopaterno, apellidomaterno, correo, edad, contrasena) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $Matricula, $Nombres, $Apellidopaterno, $Apellidomaterno, $Correo, $Edad, $Contrasena);

if ($stmt->execute()) {

    $response = array(
        'status' => 'success',
        'message' => 'Registro exitoso. ¡Bienvenido!'
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error al registrar el usuario: ' . $stmt->error
    );
    echo json_encode($response);
}

$stmt->close();


$con->close();
?>
