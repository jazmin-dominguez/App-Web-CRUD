<?php
    // Incluir la conexión a la base de datos
    require_once ('../Conexion/contacto.php');
    $obj = new Contacto();

    // Obtener todos los usuarios que son 'teachers'
    $teachers = $obj->obtener_usuarios_teachers();

    // Obtener todas las materias
    $materias = $obj->obtener_todas_materias();

    // Verificar si se ha enviado el formulario para cargar los datos del programa a modificar
    if (isset($_POST['cargar_programa'])) {
        $id_programa = $_POST['idmodificar'];
        $programa = $obj->obtener_programa_por_id($id_programa);
        if (isset($_POST['modificar_programa'])) {
            // Recibir datos del formulario
            $id_programa = $_POST['id'];
            $nombre_programa = $_POST['nombre_programa'];
            $descripcion_programa = $_POST['descripcion_programa'];
            $materia = $_POST['materia']; // El id de la materia seleccionada
            $tipo_usuario = $_POST['tipo_usuario']; // El id del teacher seleccionado
        
            // Verifica que los datos se están recibiendo correctamente
            var_dump($id_programa, $nombre_programa, $descripcion_programa, $materia, $tipo_usuario);
        }
        
    }
?>

<div class="w-full h-full flex flex-col">
    <div class="flex-grow bg-gray-100 p-6">
        <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Modify Program</h2>
            
            <!-- Selección de Programa -->
            <div class="mb-4">
                <label for="idmodificar" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-book"></i> Select Program to Modify:
                </label>
                <select id="idmodificar" name="idmodificar" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <?php
                        $programas = $obj->listar_programas();
                        while ($programa_opcion = $programas->fetch_assoc()) {
                            echo "<option value='" . $programa_opcion['id'] . "'>" . $programa_opcion['programa_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="flex justify-center">
                <input type="submit" name="cargar_programa" value="Load Program Data" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
            </div>
        </form>

        <?php if (isset($programa)): ?>
            <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-700">Update Program</h2>
                
                <!-- Nombre del Programa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nombre_programa" class="block text-gray-700 font-bold mb-2">
                            <i class="fa-solid fa-book-open-reader"></i> Program Name:
                        </label>
                        <input type="text" id="nombre_programa" name="nombre_programa" value="<?php echo htmlspecialchars($programa['nombre']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="descripcion_programa" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-info-circle"></i> Description:
                        </label>
                        <input type="text" id="descripcion_programa" name="descripcion_programa" value="<?php echo htmlspecialchars($programa['descripcion']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>

                <!-- Materia -->
                <div class="mb-4">
                    <label for="materia" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-book-open"></i> Select a Subject (Materia):
                    </label>
                    <select id="materia" name="materia" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <?php foreach ($materias as $materia): ?>
                            <option value="<?php echo $materia['id']; ?>" <?php if ($programa['FK_materia'] == $materia['id']) echo 'selected'; ?>>
                                <?php echo $materia['nombre_materia']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tipo de Usuario (Teacher) -->
                <div class="mb-4">
                    <label for="tipo_usuario" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-users"></i> Select Teacher:
                    </label>
                    <select id="tipo_usuario" name="tipo_usuario" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?php echo $teacher['id']; ?>" <?php if ($programa['FK_tipo_usuario'] == $teacher['id']) echo 'selected'; ?>>
                                <?php echo $teacher['nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Botón para modificar el programa -->
                <div class="flex justify-center">
                    <input type="hidden" name="id" value="<?php echo $programa['id']; ?>">
                    <input type="submit" name="modificar_programa" value="Update Program" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    if (isset($_POST['modificar_programa'])) {
        // Recibir datos del formulario
        $id_programa = $_POST['id'];
        $nombre_programa = $_POST['nombre_programa'];
        $descripcion_programa = $_POST['descripcion_programa'];
        $materia = $_POST['materia']; // El id de la materia seleccionada
        $tipo_usuario = $_POST['tipo_usuario']; // El id del teacher seleccionado
        
        // Llamar a la función para modificar el programa
        $resultado = $obj->modificar_programa($id_programa, $nombre_programa, $descripcion_programa, $materia, $tipo_usuario);
        
        // Mostrar mensaje de éxito o error
        if ($resultado) {
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Program Updated",
                        text: "The program has been successfully updated."
                    });
                  </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "There was a problem updating the program."
                    });
                  </script>';
        }
    }
?>
