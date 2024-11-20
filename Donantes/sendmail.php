<?php
// Importar las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar las clases de PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Variables recibidas desde el formulario
$email = "jdominguez13@ucol.mx";
$contenido = $_POST['message'];

// Crear instancia de PHPMailer
$mail = new PHPMailer(true);

// Cabecera para habilitar SweetAlert
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

try {
    // Configuración del servidor
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'agonzalez156@ucol.mx'; // Tu correo
    $mail->Password   = 'mlgv zinp elew nrwg';  // Contraseña de la app
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Destinatarios
    $mail->setFrom('agonzalez156@ucol.mx', 'UnityClass Support');
    $mail->addAddress($email);

    // Contenido del correo
    $htmlContent = <<<HTML
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            color: #333;
            border: 1px solid #ddd;
        }
        .header {
            background-color: #000080;
            color: #fff;
            padding: 10px;
        }
        .main-content {
            padding: 20px;
        }
        .footer {
            background-color: #000080;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        </style>
        </head>
        <body>
        <div class="container">
            <div class="header">
                <h1>UnityClass Contact</h1>
            </div>
            <div class="main-content">
                <h2>Contact admin</h2>
                <p>
                    $contenido
                </p>
            </div>
            <div class="footer">
                <p>Copyright © 2024 All Rights Reserved by UnityClass.</p>
            </div>
        </div>
        </body>
        </html>
    HTML;

    $mail->isHTML(true);
    $mail->Subject = 'UnityClass Support';
    $mail->Body    = $htmlContent;

    // Enviar el correo
    if ($mail->send()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Correo enviado',
                text: 'El correo fue enviado correctamente.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'dashboard.php#donations'; // Redirigir al usuario si es necesario
            });
        </script>";
    }
} catch (Exception $e) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error al enviar',
            text: 'No se pudo enviar el correo. Error: {$mail->ErrorInfo}',
            confirmButtonText: 'Aceptar'
        });
    </script>";
}
?>

