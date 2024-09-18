<?php

include("connexion.php"); // Verifica que esta conexión use la variable $conn

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturando datos del formulario
    $nombreactividad = $_POST['nombreactividad'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];
    $video = $_FILES['video'];

    // Verificar si algún campo está vacío
    if (empty($nombreactividad) || empty($tipo) || empty($descripcion) || empty($duracion) || empty($video['name'])) {
        $response = array(
            'status' => 'error',
            'message' => 'Por favor, completa todos los campos antes de enviar.'
        );
        echo json_encode($response);
        exit();
    }

    // Verificar si hay duplicados en la base de datos
    $stmt = $conn->prepare("SELECT * FROM actividades WHERE nombreactividad = ?");
    $stmt->bind_param("s", $nombreactividad);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response = array(
            'status' => 'error',
            'message' => 'La actividad que intentas crear ya existe.'
        );
        echo json_encode($response);
        exit();
    }

    // Guardar el archivo de video
    $uploadDir = 'uploads/';
    $videoPath = $uploadDir . basename($video['name']);
    
    // Verifica que el directorio exista y tenga los permisos adecuados
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Crear el directorio si no existe
    }

    // Mover el archivo cargado a la carpeta de destino
    if (!move_uploaded_file($video['tmp_name'], $videoPath)) {
        $response = array(
            'status' => 'error',
            'message' => 'Error al subir el archivo de video.'
        );
        echo json_encode($response);
        exit();
    }

    // Insertar los datos en la base de datos (solo se almacena la ruta del video)
    $stmt = $conn->prepare("INSERT INTO actividades (nombreactividad, tipo, descripcion, duracion, video) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $nombreactividad, $tipo, $descripcion, $duracion, $videoPath);

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Registro exitoso.'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error al registrar la actividad: ' . $stmt->error
        );
        echo json_encode($response);
    }

    // Cerrar el statement y la conexión
    $stmt->close();
    $conn->close();
}
?>
