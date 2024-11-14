<?php
require '../libs/dompdf/autoload.inc.php'; // Ruta a autoload.inc.php

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar opciones de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Permitir cargar imágenes remotas si es necesario
$dompdf = new Dompdf($options);

// Datos de la donación (deben ser obtenidos de la base de datos o de $_POST)
$nombre_donacion = $_POST['nombre_donacion'];
$fecha_donacion = $_POST['fecha_donacion'];
$monto = $_POST['monto'];

// Contenido HTML del PDF
$html = '
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { text-align: center; }
        .logo { width: 80px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .info { font-size: 16px; margin: 5px 0; }
        .footer { margin-top: 20px; font-size: 14px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <img src="../SRC/plantita.png" class="logo" alt="Unity Class Logo">
        <div class="title">Unity Class - Donation Receipt</div>
        <div class="info">Donor Name: ' . htmlspecialchars($nombre_donacion) . '</div>
        <div class="info">Donation Date: ' . htmlspecialchars($fecha_donacion) . '</div>
        <div class="info">Donated Amount: $' . htmlspecialchars($monto) . ' USD</div>
        <div class="footer">Thank you for your generous contribution. Your support helps provide education and resources to children who need it most.</div>
    </div>
</body>
</html>
';

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// (Opcional) Establecer el tamaño y orientación de la página
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF al navegador para su descarga
$dompdf->stream("Donation_Receipt.pdf", ["Attachment" => 1]);
?>
