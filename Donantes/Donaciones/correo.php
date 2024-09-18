<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = 'lsanmiguel@ucol.mx';
    $subject = 'Nueva Donación';
    $donation = $_POST['donation'];
    $message = "Se ha realizado una nueva donación:\n\n" . $donation;
    $headers = 'From: no-reply@yourdomain.com' . "\r\n" .
               'Reply-To: no-reply@yourdomain.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo "Correo enviado con éxito";
    } else {
        http_response_code(500);
        echo "Error al enviar el correo";
    }
} else {
    http_response_code(
