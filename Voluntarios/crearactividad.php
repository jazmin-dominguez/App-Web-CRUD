<?php
require_once ('../Conexion/contacto.php');
$contacto = new Contacto();

// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que la conexión a la base de datos está activa
if (!$contacto->conexion || $contacto->conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $contacto->conexion->connect_error);
}

// Obtener la conexión activa
$user_id = $_SESSION['user_id'];
$db = $contacto->conexion;

// Obtener todos los programas en los que está inscrito el usuario
$query_programas = "SELECT programa_id FROM inscripciones WHERE user_id = ?";
$stmt = $db->prepare($query_programas);
if (!$stmt) {
    die("Error al preparar la consulta: " . $db->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$programas = $result->fetch_all(MYSQLI_ASSOC);

// Si hay programas, obtener las materias asociadas
$materias = [];
if ($programas) {
    $programa_ids = array_column($programas, 'programa_id');
    $placeholders = implode(',', array_fill(0, count($programa_ids), '?'));

    $query_materias = "
        SELECT DISTINCT m.id, m.nombre_materia
        FROM materias m
        JOIN programas p ON p.FK_materia = m.id
        WHERE p.id IN ($placeholders)";
    $stmt = $db->prepare($query_materias);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $db->error);
    }
    $stmt->bind_param(str_repeat('i', count($programa_ids)), ...$programa_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    $materias = $result->fetch_all(MYSQLI_ASSOC);
}

// Procesar la solicitud de creación de actividad
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_actividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $id_materia = $_POST['id_materia'];

    $query_insert = "INSERT INTO actividades (nombre_actividad, descripcion, fk_materia, fecha, fk_teacher) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query_insert);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $db->error);
    }
    $stmt->bind_param("ssisi", $nombre_actividad, $descripcion, $id_materia, $fecha, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
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
    event.preventDefault();

    var formData = new FormData(this);

    fetch("crearactividad.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Activity created successfully!',
                text: 'Your activity has been created successfully.',
                confirmButtonText: 'OK'
            });
            document.getElementById("activityForm").reset();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was a problem creating the activity. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was a problem creating the activity. Please try again.',
            confirmButtonText: 'OK'
        });
    });
});
</script>

</body>
</html>
