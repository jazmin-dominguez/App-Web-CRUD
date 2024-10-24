<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
                    <form action="" method="post" class="space-y-6">
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
                            $resultado = $obj->obtenerPorId($id);

                            if ($resultado) {
                                $registro = $resultado->fetch_assoc();
                                ?>
                                <form action="" method="post" class="space-y-6 mt-8">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">

                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                        <div>
                                            <label for="nombre" class="block text-sm font-medium text-gray-700">
                                                <i class="fas fa-user"></i> Name
                                            </label>
                                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($registro['nombre']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>

                                        <div>
                                            <label for="correo" class="block text-sm font-medium text-gray-700">
                                                <i class="fas fa-envelope"></i> Email
                                            </label>
                                            <input type="email" name="correo" value="<?php echo htmlspecialchars($registro['correo']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                        <div>
                                            <label for="edad" class="block text-sm font-medium text-gray-700">
                                                <i class="fas fa-hashtag"></i> Age
                                            </label>
                                            <input type="number" name="edad" value="<?php echo htmlspecialchars($registro['edad']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>

                                        <div>
                                            <label for="sexo" class="block text-sm font-medium text-gray-700">
                                                <i class="fas fa-venus-mars"></i> Gender
                                            </label>
                                            <div class="mt-2 flex items-center space-x-4">
                                                <label class="flex items-center">
                                                    <input type="radio" name="sexo" value="Masculino" class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        <?php echo ($registro['genero'] == 'Masculino') ? 'checked' : ''; ?>>
                                                    <span class="ml-2 text-sm text-gray-700">Male</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="sexo" value="Femenino" class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        <?php echo ($registro['genero'] == 'Femenino') ? 'checked' : ''; ?>>
                                                    <span class="ml-2 text-sm text-gray-700">Female</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">
                                            <i class="fas fa-user-tag"></i> User Type
                                        </label>
                                        <select name="tipo_usuario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="Teacher" <?php echo ($registro['tipo_usuario'] == 'Teacher') ? 'selected' : ''; ?>>Teacher</option>
                                            <option value="Student" <?php echo ($registro['tipo_usuario'] == 'Student') ? 'selected' : ''; ?>>Student</option>
                                            <option value="Donor" <?php echo ($registro['tipo_usuario'] == 'Donor') ? 'selected' : ''; ?>>Donator</option>
                                            <option value="Coordinator" <?php echo ($registro['tipo_usuario'] == 'Coordinator') ? 'selected' : ''; ?>>Coordinator</option>
                                            <option value="Administrator" <?php echo ($registro['tipo_usuario'] == 'Administrator') ? 'selected' : ''; ?>>Administrator</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="fecha_nac" class="block text-sm font-medium text-gray-700">
                                            <i class="fas fa-calendar-alt"></i> Date of Birth 
                                        </label>
                                        <input type="date" name="fecha_nac" max="2014-12-12" value="<?php echo htmlspecialchars($registro['fecha_nac']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="flex justify-end space-x-4 mt-6">
                                        <input type="submit" name="modificar" value="Modificar" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 ">
                                    </div>
                                </form>
                                <?php
                            } else {
                                echo "<p class='text-red-600 mt-4'>Record could not be found.</p>";
                            }
                        }

                        if (isset($_POST['modificar'])) {
                            $id = $_POST['id'];
                            $nombre = $_POST['nombre'];
                            $correo = $_POST['correo'];
                            $edad = $_POST['edad'];
                            $sexo = $_POST['sexo'];
                            $tipo_usuario = $_POST['tipo_usuario'];
                            $fecha_nac = $_POST['fecha_nac'];
                            $obj->modificar_usuario($id, $nombre, $correo, $sexo, $edad, $tipo_usuario, $fecha_nac);
                            echo "<p class='text-blue-600 mt-4'>Data Modified</p>";
                        }
                    ?>
                </div>