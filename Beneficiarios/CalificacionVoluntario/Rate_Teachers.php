<?php
// Rate_Teachers.php

include("connexion.php");

// Obtener los datos enviados desde el cliente
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que los datos existan
if (isset($data['comentario']) && isset($data['calificacion']) && isset($_GET['matricula'])) {
    $comentario = $data['comentario'];
    $calificacion = $data['calificacion'];
    $matricula = intval($_GET['matricula']);

    // Consulta para actualizar la base de datos
    $sql = "UPDATE voluntarios SET comentario = ?, calificacion = ? WHERE matricula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $comentario, $calificacion, $matricula);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating record.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>
