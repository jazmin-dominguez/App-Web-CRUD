<?php
include("conexion.php");

// Capturar el tipo de usuario desde la URL
$tipo_usuario = isset($_GET['role']) ? $_GET['role'] : '';

// Validar que el tipo de usuario es uno de los permitidos
$tipos_permitidos = ['beneficiarios', 'voluntarios'];
if (!in_array($tipo_usuario, $tipos_permitidos)) {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid user role specified.'
    );
    echo json_encode($response);
    exit();
}

// Capturar los datos del formulario
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

// Verificar duplicados en la base de datos
$stmt = $con->prepare("SELECT * FROM $tipo_usuario WHERE matricula = ? OR correo = LOWER(?)");
$stmt->bind_param("ss", $Matricula, $Correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response = array(
        'status' => 'error',
        'message' => 'Your email and/or registration is already registered, please login!'
    );
    echo json_encode($response);
    exit();
}

// Verificar si las contraseñas coinciden
if ($Contrasena !== $Confirmarcontrasena) {
    $response = array(
        'status' => 'error',
        'message' => 'Passwords do not match, try again.'
    );
    echo json_encode($response);
    exit();
}

// Encriptar la contraseña antes de guardarla
$Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

// Insertar los datos en la base de datos según el tipo de usuario
$stmt = $con->prepare("INSERT INTO $tipo_usuario (matricula, nombres, apellidopaterno, apellidomaterno, correo, edad, contrasena) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $Matricula, $Nombres, $Apellidopaterno, $Apellidomaterno, $Correo, $Edad, $Contrasena);

if ($stmt->execute()) {
    $response = array(
        'status' => 'success',
        'message' => 'Successful Registration. ¡Welcome!',
        'redirect' => "login.php?role=" . urlencode($tipo_usuario) // Redirigir al login correspondiente
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
