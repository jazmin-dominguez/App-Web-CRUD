<?php
session_start();
include '../Conexion/contacto.php';

// Instancia de la clase Contacto
$contacto = new Contacto();

// Captura de datos desde el formulario
$nombre_donacion = $_POST['nombre_donacion'] ?? null;
$fecha_donacion = $_POST['fecha_donacion'] ?? null;
$FK_tipo_Usuario = $_SESSION['user_id'] ?? null;
$monto = $_POST['monto'] ?? null;

// Agregar campos adicionales para la factura
$direccion = $_POST['direccion'] ?? null;
$ciudad = $_POST['ciudad'] ?? null;
$estado = $_POST['estado'] ?? null;
$codigo_postal = $_POST['codigo_postal'] ?? null;

// Verificar que todos los campos requeridos están presentes
if (!$nombre_donacion || !$fecha_donacion || !$FK_tipo_Usuario || !$monto || !$direccion || !$ciudad || !$estado || !$codigo_postal) {
    die("<h1 style='color: red;'>Error: Missing required data. Please check your input.</h1>");
}

// Guardar la donación en la base de datos
$resultado = $contacto->guardar_donacion($nombre_donacion, $fecha_donacion, $FK_tipo_Usuario, $monto);

// Verificar si la donación fue guardada exitosamente
if (strpos($resultado, "Donación guardada con éxito") === false) {
    // Si no contiene "Donación guardada con éxito", muestra el mensaje como error
    die("<h1 style='color: red;'>Error: Could not save donation. $resultado</h1>");
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Invoice - Unity Class</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgba(22, 78, 99, 0.9);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-lg p-8 max-w-lg">
    <div class="text-center mb-8">
        <!-- Logo de la aplicación -->
        <img src="../SRC/plantita.png" alt="Unity Class Logo" class="mx-auto w-24 mb-4">
        <h1 class="text-2xl font-bold">Unity Class</h1>
        <p class="text-gray-600">Donation Receipt</p>
    </div>

    <div class="mb-4">
        <p><span class="font-bold">Donor Name:</span> <?php echo htmlspecialchars($nombre_donacion); ?></p>
        <p><span class="font-bold">Donation Date:</span> <?php echo htmlspecialchars($fecha_donacion); ?></p>
        <p><span class="font-bold">Donated Amount:</span> $<?php echo htmlspecialchars(number_format($monto, 2)); ?> USD</p>
        <p><span class="font-bold">Address:</span> <?php echo htmlspecialchars($direccion); ?></p>
        <p><span class="font-bold">City:</span> <?php echo htmlspecialchars($ciudad); ?></p>
        <p><span class="font-bold">State:</span> <?php echo htmlspecialchars($estado); ?></p>
        <p><span class="font-bold">Postal Code:</span> <?php echo htmlspecialchars($codigo_postal); ?></p>
    </div>

    <div class="mt-8">
        <p class="text-gray-700">Thank you for your generous contribution. Your support helps provide education and resources to children who need it most.</p>
    </div>

    <!-- Botón para descargar el PDF -->
    <form action="generar_pdf.php" method="post" target="_blank">
        <input type="hidden" name="nombre_donacion" value="<?php echo htmlspecialchars($nombre_donacion); ?>">
        <input type="hidden" name="fecha_donacion" value="<?php echo htmlspecialchars($fecha_donacion); ?>">
        <input type="hidden" name="monto" value="<?php echo htmlspecialchars($monto); ?>">
        <input type="hidden" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>">
        <input type="hidden" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>">
        <input type="hidden" name="estado" value="<?php echo htmlspecialchars($estado); ?>">
        <input type="hidden" name="codigo_postal" value="<?php echo htmlspecialchars($codigo_postal); ?>">
        <button type="submit" class="mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Download</button>
    </form>

    <div class="text-center mt-8">
        <a href="dashboard.php" class="text-blue-600 underline">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
