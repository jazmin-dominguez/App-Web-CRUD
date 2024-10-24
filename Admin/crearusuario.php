<div class="w-full h-full flex flex-col">
                    <div class="flex-grow bg-gray-100 p-6">
                        <form method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6 text-gray-700">Create User</h2>
                            
                            <!-- Contenedor de nombre y edad -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="nombre" class="block text-gray-700 font-bold mb-2">
                                        <i class="fas fa-user"></i> Name:
                                    </label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <!-- Contenedor de correo y contraseña -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="correo" class="block text-gray-700 font-bold mb-2">
                                        <i class="fas fa-envelope"></i> Email:
                                    </label>
                                    <input type="email" id="correo" name="correo" placeholder="youremail@gmail.com" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="password" class="block text-gray-700 font-bold mb-2">
                                        <i class="fas fa-lock"></i> Password:
                                    </label>
                                    <input type="password" id="password" name="password" placeholder="Contraseña" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <!-- Contenedor de género -->
                            <div class="mb-4">
                                <label for="genero" class="block text-gray-700 font-bold mb-2">
                                    <i class="fas fa-venus-mars"></i> Gender:
                                </label>
                                <div class="flex items-center">
                                    <input type="radio" id="genero1" name="genero" value="Masculino" class="mr-2" required>
                                    <label for="genero1" class="mr-4">Male</label>
                                    <input type="radio" id="genero2" name="genero" value="Femenino" class="mr-2" required>
                                    <label for="genero2">Female</label>
                                </div>
                            </div>

                            <!-- Contenedor de tipo de usuario -->
                            <div class="mb-4">
                                <label for="tipo_usuario" class="block text-gray-700 font-bold mb-2">
                                    <i class="fas fa-user-tag"></i> User Type:
                                </label>
                                <select id="tipo_usuario" name="tipo_usuario" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Selection an option</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Student">Student</option>
                                    <option value="Donor">Donator</option>
                                    <option value="Cordinator">Coordinator</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>

                            <!-- Campo de fecha de nacimiento -->
                            <div class="mb-6">
                                <label for="fecha_nac" class="block text-gray-700 font-bold mb-2">
                                    <i class="fas fa-calendar-alt"></i> Date of birth:
                                </label>
                                <input type="date" id="fecha_nac" name="fecha_nac" max="2014-12-12"  class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            </div>

                            <div class="flex justify-center">
                                <input type="submit" name="submit" value="Register" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
                            </div>
                        </form>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    if(isset($_POST['submit']))
    {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $genero = $_POST['genero'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $fecha_nac = $_POST['fecha_nac'];

        $fecha_nac_timestamp = strtotime($fecha_nac);
        $edad_calculada = date('Y') - date('Y', $fecha_nac_timestamp);

        require_once ('../Conexion/contacto.php');
        $obj = new Contacto();
        $obj->crear_usuario($nombre, $correo, $password, $genero, $edad_calculada, $tipo_usuario, $fecha_nac);
        
        // Mostrar mensaje de registro exitoso
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Registro exitoso!",
                    text: "Tu cuenta ha sido creada correctamente"
                });
            </script>';
    }
?>