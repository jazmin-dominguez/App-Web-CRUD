<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
                    <form method="post" class="space-y-6">
                        <div>
                            <label for="idmodificar" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-user-tag"></i> Select User
                            </label>
                            <select name="idmodificar" id="idmodificar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <?php
                                    require_once("../Conexion/contacto.php");
                                    $obj = new Contacto();
                                    $resultado = $obj->listar_usuarios();
                                    
                                    if ($resultado) {
                                        while ($registro = $resultado->fetch_assoc()) {
                                            echo "<option value='" . $registro["id"] . "'>" . $registro["nombre"] . "</option>";
                                        }
                                    } else {
                                        echo "<option>No resoults found</option>";
                                    }
                                ?>
                            </select>
                        </div>
            
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <input type="submit" name="cargar" value="Delete User" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium px-4 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600">
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php
                if (isset($_POST['cargar'])) {
                    $id = $_POST['idmodificar'];
                    $obj->eliminar_usuario($id); // Asegúrate de tener esta función en tu clase Contacto
                    echo "<p class='text-blue-600 mt-4'>User successfully deleted</p>";
                    
                }