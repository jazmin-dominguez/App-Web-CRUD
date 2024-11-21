<?php  
// Incluir la conexión a la base de datos
require_once('../Conexion/contacto.php');
$obj = new Contacto();

// Obtener todas las materias disponibles
$materias = $obj->obtener_todas_materiasinfo();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- SweetAlert2 -->
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="w-full h-full flex flex-col items-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-700">Select your Subject</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($materias as $materia): ?>
                <?php 
                    // Verificar si el usuario ya está inscrito en esta materia
                    $inscrito = $obj->verificar_inscripcion($user_id, $materia['id']);
                ?>
                <div class="border-2 border-cyan-500 rounded-md p-4 text-center">
                    <h3 class="text-xl font-bold"><?php echo $materia['nombre_materia']; ?></h3>
                    
                    <button 
                        onclick="showPopup(<?php echo htmlspecialchars(json_encode($materia)); ?>)"
                        class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-md">
                        Details
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Popup de detalles de la materia -->
    <div id="popup" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 relative">
            <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
            <div id="popupContent" class="text-center">
                <!-- Contenido dinámico del popup -->
                <p class="text-justify text-gray-700"><?php echo $materia['objetivos']; ?></p>
            </div>
        </div>
    </div>

    <script>
        let selectedMateriaId = null;

        // Mostrar el popup con los detalles de la materia
        function showPopup(materia) {
            const popupContent = document.getElementById('popupContent');
            const idioma = Weglot.getCurrentLang(); // Obtén el idioma actual

            // Textos dinámicos según el idioma
            let enrollText, closeText;

            if (idioma === "es") {
                enrollText = "Inscribirse";
                closeText = "Cerrar";
            } else if (idioma === "fr") {
                enrollText = "S'inscrire";
                closeText = "Fermer";
            } else {
                enrollText = "Enroll"; // Idioma por defecto (inglés)
                closeText = "Close";
            }

            selectedMateriaId = materia.id; // Guarda el ID de la materia seleccionada
            popupContent.innerHTML = `
                <h3 class="text-xl font-bold">${materia.nombre_materia}</h3>
                <br>
                <p class="text-justify text-gray-700">${materia.objetivos || 'relevant topics'}</p>
                <div class="flex justify-center gap-4 mt-4">
                    <button 
                        id="inscripcion-btn-${materia.id}"
                        onclick="inscribirUsuario(event, ${materia.id})"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                        ${enrollText}
                    </button>
                    <button onclick="closePopup()" class="bg-red-400 hover:bg-red-500 text-gray-700 px-4 py-2 rounded-md">
                        ${closeText}
                    </button>
                </div>
            `;
            document.getElementById('popup').classList.remove('hidden');
        }


        // Cerrar el popup
        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }

        // Función para inscribir al usuario en la materia seleccionada
function inscribirUsuario(event, materiaId) {
    event.preventDefault();

    const idioma = Weglot.getCurrentLang(); // Obtiene el idioma actual
    let successTitle, successMessage, alreadyEnrolledTitle, alreadyEnrolledMessage, errorTitle, errorMessage;

    // Define los textos en función del idioma
    if (idioma === "es") {
        successTitle = "¡Inscripción exitosa!";
        successMessage = "Te has inscrito correctamente en la materia.";
        alreadyEnrolledTitle = "Ya inscrito";
        alreadyEnrolledMessage = "Ya estás inscrito en esta materia.";
        errorTitle = "Error";
        errorMessage = "Hubo un problema al intentar inscribirte. Por favor, inténtalo de nuevo.";
    } else if (idioma === "fr") {
        successTitle = "Inscription réussie!";
        successMessage = "Vous vous êtes inscrit avec succès au cours.";
        alreadyEnrolledTitle = "Déjà inscrit";
        alreadyEnrolledMessage = "Vous êtes déjà inscrit à ce cours.";
        errorTitle = "Erreur";
        errorMessage = "Un problème est survenu lors de votre inscription. Veuillez réessayer.";
    } else {
        // Idioma por defecto (inglés)
        successTitle = "Successful Enrollment";
        successMessage = "You have successfully enrolled in the subject.";
        alreadyEnrolledTitle = "Already Enrolled";
        alreadyEnrolledMessage = "You are already enrolled in this subject.";
        errorTitle = "Error";
        errorMessage = "There was a problem trying to enroll you. Please try again.";
    }

    // Enviar solicitud para inscribir al usuario
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
                title: successTitle,
                text: successMessage,
                confirmButtonText: 'OK'
            }).then(() => {
                closePopup();
                const button = document.getElementById(`inscripcion-btn-${materiaId}`);
                button.textContent = idioma === "es" ? "Inscrito" : idioma === "fr" ? "Inscrit" : "Enrolled";
                button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                button.classList.add('bg-gray-400', 'cursor-not-allowed');
                button.disabled = true;
            });
        } else if (response.trim() === "already_enrolled") {
            Swal.fire({
                icon: 'info',
                title: alreadyEnrolledTitle,
                text: alreadyEnrolledMessage,
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: errorTitle,
                text: errorMessage,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: errorTitle,
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    });
}

    </script>
    

</body>
</html>
