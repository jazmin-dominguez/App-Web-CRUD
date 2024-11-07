<?php
require_once ('../Conexion/contacto.php');
$contacto = new Contacto();

// Obtener todos los usuarios 'teachers' y todas las materias
$teachers = $contacto->obtener_usuarios_teachers();
$materias = $contacto->obtener_todas_materias();

// Procesar la solicitud de creación de actividad
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre_actividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $id_materia = $_POST['id_materia'];
    $id_usuario = $_POST['id_usuario'];

    // Crear la actividad en la base de datos
    $resultado = $contacto->crear_actividad($nombre_actividad, $descripcion, $fecha, $id_materia, $id_usuario);

    if ($resultado) {
        // Enviar respuesta de éxito
        echo "success";
    } else {
        // Enviar respuesta de error
        echo "error";
    }
    exit; // Terminar el script después de enviar la respuesta
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

<div class="w-full h-full flex flex-col">
    <div class="flex-grow bg-gray-100 p-6">
        <form id="activityForm" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Create Activity</h2>

            <!-- Nombre de la Actividad y Descripción -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nombre_actividad" class="block text-gray-700 font-bold mb-2">Activity Name:</label>
                    <input type="text" id="nombre_actividad" name="nombre_actividad" placeholder="Asigna un nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">Description:</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Describe la actividad" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label for="fecha" class="block text-gray-700 font-bold mb-2">Date:</label>
                <input type="date" id="fecha" name="fecha" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Materia -->
            <div class="mb-4">
                <label for="id_materia" class="block text-gray-700 font-bold mb-2">Subject:</label>
                <select id="id_materia" name="id_materia" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <?php foreach ($materias as $materia): ?>
                        <option value="<?php echo $materia['id']; ?>"><?php echo $materia['nombre_materia']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Teacher -->
            <div class="mb-4">
                <label for="id_usuario" class="block text-gray-700 font-bold mb-2">Teacher:</label>
                <select id="id_usuario" name="id_usuario" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <?php foreach ($teachers as $teacher): ?>
                        <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botón de Crear Actividad -->
            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">Crear Actividad</button>
            </div>
        </form>
    </div>
</div>

<script>
// Manejar el envío del formulario mediante JavaScript y Fetch API
document.getElementById("activityForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    // Crea un objeto FormData para enviar los datos
    var formData = new FormData(this);

    // Enviar la solicitud AJAX
    fetch("crearactividad.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "success") {
            // Muestra la alerta de éxito con SweetAlert2
            Swal.fire({
                icon: 'success',
                title: '¡Actividad creada exitosamente!',
                text: 'Tu actividad ha sido creada correctamente.',
                confirmButtonText: 'OK'
            });
            
            // Limpiar el formulario después de la creación exitosa
            document.getElementById("activityForm").reset();
        } else {
            // Muestra una alerta de error si la respuesta no es "success"
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al crear la actividad. Inténtalo de nuevo.',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al crear la actividad. Inténtalo de nuevo.',
            confirmButtonText: 'OK'
        });
    });
});
</script>

</body>
</html>
