<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <form action="" method="post" class="space-y-6">
        <div>
            <label for="idmodificar" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-book"></i> Select Subject
            </label>
            <select name="idmodificar" id="idmodificar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <?php
                    require_once("../Conexion/contacto.php");
                    $obj = new Contacto();
                    $resultado = $obj->listar_materias();
                    
                    if ($resultado) {
                        while ($registro = $resultado->fetch_assoc()) {
                            echo "<option value='" . $registro["id"] . "'>" . $registro["nombre_materia"] . "</option>";
                        }
                    } else {
                        echo "<option>No results found</option>";
                    }
                ?>
            </select>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <input type="submit" name="cargar" value="Load Data" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
            </div>
        </div>
    </form>

    <?php
        if (isset($_POST['cargar'])) {
            $id = $_POST['idmodificar'];
            $resultado = $obj->obtener_materia_por_id($id);

            if ($resultado) {
                $registro = $resultado->fetch_assoc();
                ?>
                <form action="" method="post" class="space-y-6 mt-8">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="nombre_materia" class="block text-sm font-medium text-gray-700">
                                <i class="fa-solid fa-book-open-reader"></i> Subject Name
                            </label>
                            <input type="text" name="nombre_materia" value="<?php echo htmlspecialchars($registro['nombre_materia']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="objetivos" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-bullseye"></i> Objectives
                            </label>
                            <textarea name="objetivos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?php echo htmlspecialchars($registro['objetivos']); ?></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <input type="submit" name="modificar" value="Update Subject" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 ">
                    </div>
                </form>
                <?php
            } else {
                echo "<p class='text-red-600 mt-4'>Subject could not be found.</p>";
            }
        }

        if (isset($_POST['modificar'])) {
            $id = $_POST['id'];
            $nombre_materia = $_POST['nombre_materia'];
            $objetivos = $_POST['objetivos'];

            $obj->modificar_materia($id, $nombre_materia, $objetivos);
            echo "<p class='text-blue-600 mt-4'>Subject Updated Successfully</p>";
        }
    ?>
</div>
