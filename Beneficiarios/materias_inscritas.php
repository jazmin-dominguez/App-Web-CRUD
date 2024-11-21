<?php
// session_start();
require_once('../Conexion/contacto.php');

$obj = new Contacto();
$user_id = $_SESSION['user_id'];

// Obtener los programas según las materias inscritas por el usuario
$materias  = $obj->obtener_materias_inscritas($user_id);
?>

<div class="w-full h-full flex flex-col items-center">
    <br>
    <br>
    <h2 class="text-3xl font-bold mb-6 text-gray-700 ">Subjects Enrolled</h2>
<br>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:ml-8 lg:mr-4 ">
        <?php if (!empty($materias)): ?>
            <?php foreach($materias as $materia): ?>
                <div class="border-2 border-cyan-500 rounded-md p-4 text-center ">
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars($materia['nombre_materia']); ?></h3>
                    <p class="text-justify text-gray-700"><?php echo htmlspecialchars($materia['objetivos']); ?></p>
                    <br>

                    <!-- Botón para eliminar inscripción -->
                    <button 
                        onclick="desinscribirUsuario(<?php echo $materia['id']; ?>)" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                        Unenroll
                    </button>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600">There are no subjects available classes for the subjects you are enrolled in.</p>
        <?php endif; ?>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Función para desinscribir al usuario
    function desinscribirUsuario(materiaId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this enrollment!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, unenroll me!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('desinscribir_materia.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `materia_id=${materiaId}`
                })
                .then(response => response.text())
                .then(response => {
                    if (response.trim() === "success") {
                        Swal.fire(
                            'Unenrolled!',
                            'You have successfully unenrolled from the subject.',
                            'success'
                        ).then(() => {
                            // Eliminar el elemento de la página sin recargar
                            document.querySelector(`button[onclick="desinscribirUsuario(${materiaId})"]`).parentElement.remove();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'An error occurred while trying to unenroll. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire(
                        'Error',
                        'An unexpected error occurred. Please try again later.',
                        'error'
                    );
                });
            }
        });
    }
</script>