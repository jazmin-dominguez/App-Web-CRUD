<div class="w-full h-full flex flex-col">
    <div class="flex-grow bg-gray-100 p-6">
        <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Create Program</h2>
            
            <!-- Contenedor de Nombre del Programa -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nombre_programa" class="block text-gray-700 font-bold mb-2">
                        <i class="fa-solid fa-book-open-reader"></i> Program Name:
                    </label>
                    <input type="text" id="nombre_programa" name="nombre_programa" placeholder="Assign a name to your program" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="descripcion_programa" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-info-circle"></i> Description:
                    </label>
                    <input type="text" id="descripcion_programa" name="descripcion_programa" placeholder="Describe your program" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>
            </div>

            <!-- Contenedor de Materia -->
            <div class="mb-4">
                <label for="materia" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-book-open"></i> Select a Subject (Materia):
                </label>
                <select id="materia" name="materia" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="1">Materia 1</option>
                    <option value="2">Materia 2</option>
                    <!-- Agrega más opciones de materias según tu base de datos -->
                </select>
            </div>

            <!-- Contenedor de Tipo de Usuario -->
            <div class="mb-4">
                <label for="tipo_usuario" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-users"></i> Select User Type:
                </label>
                <select id="tipo_usuario" name="tipo_usuario" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="1">User Type 1</option>
                    <option value="2">User Type 2</option>
                    <!-- Agrega más opciones de tipos de usuario según tu base de datos -->
                </select>
            </div>

            <div class="flex justify-center">
                <input type="submit" name="submit_programa" value="Create Program" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
            </div>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit_programa']))
    {
        // Recibir datos del formulario
        $nombre_programa = $_POST['nombre_programa'];
        $descripcion_programa = $_POST['descripcion_programa'];
        $materia = $_POST['materia'];
        $tipo_usuario = $_POST['tipo_usuario'];

        // Incluir la conexión a la base de datos
        require_once ('../Conexion/contacto.php');
        $obj = new Contacto();
        
        // Llamar a la función para crear el programa
        $obj->crear_programa($nombre_programa, $descripcion_programa, $materia, $tipo_usuario);
    }
?>
