<?php
include("connexion.php");

// Obtener el ID del voluntario de la URL
$matricula = isset($_GET['matricula']) ? intval($_GET['matricula']) : 0;

// Consultar la base de datos para obtener la información del voluntario
$sql = "SELECT foto FROM voluntarios WHERE matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $matricula);
$stmt->execute();
$result = $stmt->get_result();
$voluntario = $result->fetch_assoc();

if ($voluntario && !empty($voluntario['foto'])) {
    // Configurar los encabezados para la imagen
    header("Content-Type: image/jpeg"); // Ajusta el tipo MIME según el formato de la imagen
    echo $voluntario['foto'];
} else {
    // Mostrar una imagen por defecto o un mensaje si no hay imagen
    header("Content-Type: image/png");
    readfile("default_image.png"); // Imagen por defecto
}
?>
