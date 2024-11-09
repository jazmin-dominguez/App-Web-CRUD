<?php 
// Incluir la conexión a la base de datos
require_once('../Conexion/contacto.php');
$obj = new Contacto();

// Obtener todos los programas disponibles
$programas = $obj->obtener_todos_programas();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas Disponibles</title>
    <link rel="stylesheet" href="ruta/a/tu/estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- SweetAlert2 -->
</head>
<body>
    <div class="w-full h-full flex flex-col items-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-700">Select Your Program</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($programas as $programa): ?>
                <?php 
                    // Verificar si el usuario ya está inscrito en este programa
                    $inscrito = $obj->verificar_inscripcion($user_id, $programa['id']);
                ?>
                <div class="border-2 border-red-500 rounded-md p-4 text-center">
                    <img src="../SRC/icono-de-concepto-programas-educativos.webp" alt="Imagen del Programa" class="mx-auto mb-3" style="width: 170px; height: auto;">
                    <h3 class="text-xl font-bold"><?php echo $programa['nombre']; ?></h3>
                    <p class="text-gray-700"><?php echo $programa['descripcion']; ?></p>
                    <p class="text-gray-500"><?php echo $programa['nombre_materia']; ?></p>
                    
                    <button 
                        id="inscripcion-btn-<?php echo $programa['id']; ?>"
                        onclick="inscribirUsuario(event, <?php echo $programa['id']; ?>)" 
                        class="mt-4 px-4 py-2 font-bold rounded-md <?php echo $inscrito ? 'bg-gray-400 text-white cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'; ?>"
                        <?php echo $inscrito ? 'disabled' : ''; ?>>
                        <?php echo $inscrito ? 'Inscrito' : 'Inscribirse'; ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Mensaje de éxito o error -->
    <div id="mensaje" style="margin-top: 20px;"></div>

    <script>
    // Función AJAX para inscribir al usuario
    function inscribirUsuario(event, programaId) {
    event.preventDefault(); // Evita el envío del formulario tradicional

    fetch('inscribirse.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `programa_id=${programaId}`
    })
    .then(response => response.text())
    .then(response => {
        switch (response.trim()) {
            case "success":
                Swal.fire({
                    icon: 'success',
                    title: 'Successful Enrollment',
                    text: 'You have successfully enrolled in the program.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Actualiza el botón para mostrar que el usuario está inscrito
                    const button = document.getElementById(`inscripcion-btn-${programaId}`);
                    button.textContent = "Inscrito";
                    button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    button.classList.add('bg-gray-400', 'cursor-not-allowed');
                    button.disabled = true; // Desactiva el botón
                });
                break;
            case "already_enrolled":
                Swal.fire({
                    icon: 'info',
                    title: 'Already Enrolled',
                    text: 'You are already enrolled in this program.',
                    confirmButtonText: 'OK'
                });
                break;
            case "no_program_selected":
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Select a program to enroll in.',
                    confirmButtonText: 'OK'
                });
                break;
            case "no_permission":
                Swal.fire({
                    icon: 'error',
                    title: 'No Permissions',
                    text: 'You do not have permissions to enroll in programs.',
                    confirmButtonText: 'OK'
                });
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was a problem trying to enroll you. Please try again.',
                    confirmButtonText: 'OK'
                });
                break;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al intentar inscribirte. Por favor intenta nuevamente.',
            confirmButtonText: 'OK'
        });
    });
}

    </script>

</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
}

h2 {
    color: #333;
}

.grid {
    display: grid;
    gap: 20px;
}

.grid-cols-2 {
    grid-template-columns: 2fr;
}

@media(min-width: 768px) {
    .grid-cols-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}

.border-2 {
    border-width: 2px;
}

.border-red-500 {
    border-color: #ff0000;
}

.bg-blue-500 {
    background-color: #007bff;
}

.bg-blue-600:hover {
    background-color: #0056b3;
}

.bg-gray-400 {
    background-color: #b0b0b0;
}

.cursor-not-allowed {
    cursor: not-allowed;
}

.rounded-md {
    border-radius: 8px;
}
</style>
