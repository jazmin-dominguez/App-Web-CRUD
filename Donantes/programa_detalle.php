<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Programa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgba(22, 78, 99, 0.9);
            font-family: 'Arial', sans-serif;
        }
        .card-background {
            background-color: rgba(255, 255, 255, 0.9);
        }
        .primary-color {
            color: rgba(22, 78, 99, 0.9);
        }
        .primary-bg {
            background-color: rgba(22, 78, 99, 0.9);
        }
        .secondary-bg {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <?php
    // Incluir la conexión y obtener los datos necesarios
    include '../Conexion/contacto.php';
    $contacto = new Contacto();

    $programa = null;
    $materias = [];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $programa = $contacto->obtener_programa_por_id($id);
        $materias = $contacto->obtener_materias_por_programa($id);
    }
    ?>
    <div class="w-full max-w-2xl mx-auto p-6 card-background shadow-lg rounded-lg">
        <div class="text-center">
            <h1 class="text-3xl font-bold primary-color mb-1">
                <?php echo htmlspecialchars($programa['nombre'] ?? 'Program Name Not Available'); ?>
            </h1>
            <p class="text-gray-600 mb-6">
                <?php echo htmlspecialchars($programa['descripcion'] ?? 'Description Not Available'); ?>
            </p>
        </div>

        <div class="secondary-bg p-4 rounded-lg">
            <h2 class="text-2xl font-semibold primary-color mb-4">Subjects</h2>
            <ul>
                <?php if (!empty($materias)) : ?>
                    <?php foreach ($materias as $materia) : ?>
                        <li class="p-4 mb-4 bg-white rounded-lg shadow-sm border-l-4" style="border-color: rgba(22, 78, 99, 0.9);">
                            <h3 class="text-lg font-bold primary-color">
                                <?php echo htmlspecialchars($materia['nombre_materia'] ?? 'Nombre no disponible'); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php echo htmlspecialchars($materia['objetivos'] ?? 'Objetivos no disponibles'); ?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="p-4 text-center text-gray-500">No subjects available</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="mt-6 text-center">
            <a href="dashboard.php" class="inline-block primary-bg text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-800 transition duration-200">Go Back</a>
        </div>
    </div>
</body>
</html>
