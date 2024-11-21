<?php include '../funciones.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
<?php incluirWeglot(); ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/registro2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
<div class="container-page" id="Container">
    <div class="login-container" id="LoginContainer">
        <form method="post">
            <h2 class="text-2xl font-bold mb-6 text-white-700">Create User</h2>
            
            <!-- Contenedor de nombre y edad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nombre" class="block text-white-700 font-bold mb-2">
                        <i class="fas fa-user"></i> Name:
                    </label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md" required>
                </div>
            </div>

            <!-- Contenedor de correo y contraseña -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="correo" class="block text-white-700 font-bold mb-2">
                        <i class="fas fa-envelope"></i> Email:
                    </label>
                    <input type="email" id="correo" name="correo" placeholder="youremail@gmail.com" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="password" class="block text-white-700 font-bold mb-2">
                        <i class="fas fa-lock"></i> Password:
                    </label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md" required>
                </div>
            </div>

            <!-- Contenedor de género -->
            <div class="mb-4">
                <label for="genero" class="block text-white-700 font-bold mb-2">
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
                <label for="tipo_usuario" class="block text-white-700 font-bold mb-2">
                    <i class="fas fa-user-tag"></i> User Type:
                </label>
                <select id="tipo_usuario" name="tipo_usuario" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md" required>
                    <option value="">Selection an option</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Student">Student</option>
                    <option value="Donor">Donator</option>
                </select>
            </div>

            <!-- Campo de fecha de nacimiento -->
            <div class="mb-6">
                <label for="fecha_nac" class="block text-white-700 font-bold mb-2">
                    <i class="fas fa-calendar-alt"></i> Date of birth:
                </label>
                <input type="date" id="fecha_nac" name="fecha_nac" max="2024-12-12" min="1990-01-01" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-md" required>
            </div>

            <div class="flex flex-col items-center">
                <button type="button" id="registerButton" class="px-4 py-2 mb-4 bg-cyan-700 text-white font-bold rounded-md hover:bg-blue-600">
                    Register
                </button>
                <a href="login.php" class="text-blue-500 hover:underline">You have an account?</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $genero = $_POST['genero'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $fecha_nac = $_POST['fecha_nac'];

    // Validar rango de fechas
    $fecha_min = strtotime('1990-01-01');
    $fecha_max = strtotime('2024-12-12');
    $fecha_nac_timestamp = strtotime($fecha_nac);

    // Validar que el nombre no sea solo números
    if (preg_match('/^\d+$/', $nombre)) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Nombre no válido",
                    text: "El nombre no puede contener solo números."
                });
              </script>';
    } elseif ($fecha_nac_timestamp < $fecha_min || $fecha_nac_timestamp > $fecha_max) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Fecha no válida",
                    text: "La fecha de nacimiento debe estar entre 1990 y 2024."
                });
              </script>';
    } elseif (strlen($password) < 8) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "La contraseña debe tener al menos 8 caracteres."
                });
              </script>';
    } else {
        require_once('../Conexion/contacto.php');
        $obj = new Contacto();

        // Validar que el correo no esté registrado
        $correo_existente = $obj->verificar_correo($correo);
        if ($correo_existente) {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Correo ya registrado",
                        text: "Este correo ya está en uso. Por favor, utiliza otro correo."
                    });
                  </script>';
        } else {
            // Calcular la edad
            $edad_calculada = date('Y') - date('Y', $fecha_nac_timestamp);

            // Registrar usuario
            $obj->crear_usuario($nombre, $correo, $password, $genero, $edad_calculada, $tipo_usuario, $fecha_nac);

            // Mostrar mensaje de éxito
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Registro exitoso!",
                        text: "Tu cuenta ha sido creada correctamente."
                    });
                  </script>';
        }
    }
}
?>
