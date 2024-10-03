<?php

include("conexion.php");

// Capturando datos del formulario
$Matricula = $_POST['matricula'];
$Nombres = $_POST['nombres'];
$Apellidopaterno = $_POST['apellidopaterno'];
$Apellidomaterno = $_POST['apellidomaterno'];
$Correo = $_POST['correo'];
$Edad = $_POST['edad'];
$Contrasena = $_POST['contrasena'];
$Confirmarcontrasena = $_POST['confirmarcontrasena'];

// Verificar si algún campo está vacío
if (empty($Matricula) || empty($Nombres) || empty($Apellidopaterno) || empty($Apellidomaterno) || empty($Correo) || empty($Edad) || empty($Contrasena) || empty($Confirmarcontrasena)) {
    $response = array(
        'status' => 'error',
        'message' => 'Please complete all fields before submitting.'
    );
    echo json_encode($response);
    exit();
}

// Verificación de duplicados en la base de datos
$stmt = $con->prepare("SELECT * FROM beneficiarios WHERE matricula = ? OR correo = LOWER(?)");
$stmt->bind_param("ss", $Matricula, $Correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response = array(
        'status' => 'error',
        'message' => 'Your email and/or beneficiary registration is already registered, please login!'
    );
    echo json_encode($response);
    exit();
}

// Verificar si las contraseñas coinciden
if ($Contrasena !== $Confirmarcontrasena) {
    $response = array(
        'status' => 'error',
        'message' => 'Incorrect password, Try again.'
    );
    echo json_encode($response);
    exit();
}

// Encriptar la contraseña antes de guardarla
$Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT); 

// Insertar los datos en la base de datos
$stmt = $con->prepare("INSERT INTO beneficiarios (matricula, nombres, apellidopaterno, apellidomaterno, correo, edad, contrasena) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $Matricula, $Nombres, $Apellidopaterno, $Apellidomaterno, $Correo, $Edad, $Contrasena);

if ($stmt->execute()) {
    $response = array(
        'status' => 'success',
        'message' => 'Succesful Registration. ¡Welcome!'
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error when registering the user: ' . $stmt->error
    );
    echo json_encode($response);
}

// Cerrar la conexión y el statement
$stmt->close();
$con->close();
?>
