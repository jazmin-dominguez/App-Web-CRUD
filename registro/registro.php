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
        'message' => 'Por favor, completa todos los campos antes de enviar.'
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
        'message' => 'El correo y/o la matricula de beneficiario ya están registrados. ¡Inicia Sesión!'
    );
    echo json_encode($response);
    exit();
}

// Verificar si las contraseñas coinciden
if ($Contrasena !== $Confirmarcontrasena) {
    $response = array(
        'status' => 'error',
        'message' => 'Las contraseñas no coinciden. Por favor, verifica.'
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

// Cerrar la conexión y el statement
$stmt->close();
$con->close();
?>
