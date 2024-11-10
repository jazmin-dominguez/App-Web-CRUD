<?php  
// Incluir la conexión a la base de datos
require_once('../Conexion/contacto.php');
$obj = new Contacto();

// Obtener todas las materias disponibles
$materias = $obj->obtener_todas_materias();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias Disponibles</title>
    <link rel="stylesheet" href="ruta/a/tu/estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="w-full h-full flex flex-col items-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-700">Select your Subject</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($materias as $materia): ?>
                <?php 
                    // Verificar si el usuario ya está inscrito en esta materia
                    $inscrito = $obj->verificar_inscripcion($user_id, $materia['id']);
                ?>
                <div class="border-2 border-red-500 rounded-md p-4 text-center">
                    <h3 class="text-xl font-bold"><?php echo $materia['nombre_materia']; ?></h3>
                    <button 
                        id="inscripcion-btn-<?php echo $materia['id']; ?>"
                        onclick="inscribirUsuario(event, <?php echo $materia['id']; ?>)" 
                        class="mt-4 px-4 py-2 font-bold rounded-md <?php echo $inscrito ? 'bg-gray-400 text-white cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'; ?>"
                        <?php echo $inscrito ? 'disabled' : ''; ?>>
                        <?php echo $inscrito ? 'Enrolled' : 'Enroll'; ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    function inscribirUsuario(event, materiaId) {
        event.preventDefault();

        fetch('inscribirse_materia.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `materia_id=${materiaId}`
        })
        .then(response => response.text())
        .then(response => {
            if (response.trim() === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful Enrollment',
                    text: 'You have successfully enrolled in the subject.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    const button = document.getElementById(`inscripcion-btn-${materiaId}`);
                    button.textContent = "Inscrito";
                    button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    button.classList.add('bg-gray-400', 'cursor-not-allowed');
                    button.disabled = true;
                });
            } else if (response.trim() === "already_enrolled") {
                Swal.fire({
                    icon: 'info',
                    title: 'Already enrolled',
                    text: 'You are already enrolled in this subject.',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was a problem trying to enroll you. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: ' There was a problem trying to enroll you. Please try again.',
                confirmButtonText: 'OK'
            });
        });
    }
    </script>

</body>
</html>
