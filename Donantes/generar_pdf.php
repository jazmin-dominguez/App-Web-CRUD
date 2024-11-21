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
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
$codigo_postal = $_POST['codigo_postal'];

// Contenido HTML del PDF
$html = '
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .ticket {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px dashed #000;
            text-align: center;
            border-radius: 10px;
        }
        .ticket img {
            max-width: 80px;
            margin-bottom: 10px;
        }
        .ticket h1 {
            font-size: 18px;
            margin: 10px 0;
        }
        .ticket p {
            margin: 5px 0;
            font-size: 14px;
        }
        .ticket .section {
            margin: 10px 0;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .ticket .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <img src="../SRC/plantita.png" alt="Unity Class Logo">
        <h1>Unity Class - Donation Receipt</h1>
        <p><strong>Donor Name:</strong> ' . htmlspecialchars($nombre_donacion) . '</p>
        <p><strong>Donation Date:</strong> ' . htmlspecialchars($fecha_donacion) . '</p>
        <p><strong>Donated Amount:</strong> $' . htmlspecialchars($monto) . ' USD</p>
        <div class="section">
            <p><strong>Address:</strong> ' . htmlspecialchars($direccion) . '</p>
            <p><strong>City:</strong> ' . htmlspecialchars($ciudad) . '</p>
            <p><strong>State:</strong> ' . htmlspecialchars($estado) . '</p>
            <p><strong>Postal Code:</strong> ' . htmlspecialchars($codigo_postal) . '</p>
        </div>
        <div class="footer">
            Thank you for your generous contribution.<br>
            Your support helps provide education and resources<br>
            to children who need it most.
        </div>
    </div>
</body>
</html>
';

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// (Opcional) Establecer el tamaño y orientación de la página (tipo ticket, estrecho)
$dompdf->setPaper([0, 0, 300, 600]); // Tamaño en puntos (px), equivalente a 3x6 pulgadas

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF al navegador para su descarga
$dompdf->stream("Donation_Receipt.pdf", ["Attachment" => 1]);
?>
