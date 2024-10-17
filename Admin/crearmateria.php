<div class="w-full h-full flex flex-col">
                    <div class="flex-grow bg-gray-100 p-6">
                        <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6 text-gray-700">Create subject</h2>
                            
                            <!-- Contenedor de Nombre de la materia -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="nombre_materia" class="block text-gray-700 font-bold mb-2">
                                        <i class="fas fa-user"></i> Subject name:
                                    </label>
                                    <input type="text" id="nombre_materia" name="nombre_materia" placeholder="Assing a name to your subject" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="descripcion" class="block text-gray-700 font-bold mb-2">
                                        <i class="fas fa-hashtag"></i> Description:
                                    </label>
                                    <input type="text" id="descripcion" name="descripcion" placeholder="Describe your subject" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <!-- Contenedor de actividades -->
                            <div class="mb-4">
                                <label for="actividades" class="block text-gray-700 font-bold mb-2">
                                    <i class="fas fa-user-tag"></i> Select an activity:
                                </label>
                                <select id="actividades" name="actividades" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="activity1">activity 1</option>
                                    <option value="activity2">activity 2</option>
                                    <option value="activity3">activity 3</option>
                                    <option value="activity4">activity 4</option>
                                    <option value="activity5">activity 5</option>
                                    <option value="activity6">activity 6</option>
                                </select>
                            </div>

                            <div class="flex justify-center">
                                <input type="submit" name="submit" value="Register" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
                            </div>
                        </form>
                    </div>
                </div>

<?php
    if(isset($_POST['submit']))
    {
        $nombre_materia = $_POST['nombre_materia'];
        $descripcion = $_POST['descripcion'];

        require_once ('../Conexion/contacto.php');
        $obj = new Contacto();
        $obj->crear_materia($nombre_materia, $descripcion);
    }
?>