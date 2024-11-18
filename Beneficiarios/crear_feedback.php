<div class="w-full h-full flex flex-col">
    <div class="flex-grow bg-gray-100 p-6">
        <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Provide Feedback</h2>
            
            <!-- Seleccionar programa -->
            <div class="mb-4">
                <label for="programa" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-book"></i> Program:
                </label>
                <select id="programa" name="programa" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="">Select a program</option>
                    <?php
                    require_once('../Conexion/contacto.php');
                    $obj = new Contacto();
                    $programas = $obj->obtener_todos_programas(); // Función que debe devolver los programas disponibles
                    foreach ($programas as $programa) {
                        echo "<option value='{$programa['id']}'>{$programa['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Comentario del feedback -->
            <div class="mb-4">
                <label for="comentario" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-comment-dots"></i> Feedback:
                </label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="Write your feedback here..." class="w-full px-3 py-2 border border-gray-300 rounded-md" required></textarea>
            </div>

            <div class="flex justify-center">
                <input type="submit" name="submit_feedback" value="Submit Feedback" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['submit_feedback'])) {
    // Obtener los datos del formulario
    $programa_id = $_POST['programa']; // Corregido para tomar el valor de 'programa'
    $comentario = $_POST['comentario'];
        // Crear el objeto de contacto y ejecutar el método de creación de feedback
        require_once('../Conexion/contacto.php');
        $obj = new Contacto();
        $resultado = $obj->crear_feedback($usuario_id, $programa_id, $comentario);

        // Mostrar mensaje de feedback exitoso
        if ($resultado) {
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Thank you for your feedback!",
                        text: "Your feedback has been successfully submitted.",
                        confirmButtonText: "Awesome"
                    });
                </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "There was a problem submitting your feedback. Please try again.",
                        confirmButtonText: "Okay"
                    });
                </script>';
        }
    }

?>
