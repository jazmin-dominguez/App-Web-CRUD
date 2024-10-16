<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../CSS/style_register.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form class="form" id="registrationForm" method="POST">
                <h2 class="form_title title">Create Account</h2>
                <input class="form__input" type="text" name="nombres" placeholder="Name">
                <input class="form__input" type="email" name="correo" placeholder="Correo">
                <input class="form__input" type="text" name="edad" placeholder="age">
                <select class="form__input" name="genero" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Masculino">Male</option>
                    <option value="Femenino">Female</option>
                </select>
                <input class="form__input" type="date" name="fecha_nac" placeholder="birthday">
                <input class="form__input" type="password" name="contrasena" placeholder="Password">

                <!-- Select de tipo de usuario -->
                <select class="form__input" name="tipo_usuario" required>
                    <option value="" disabled selected>Seleccione su tipo de usuario</option>
                    <option value="Donador">Donador</option>
                    <option value="Maestro">Maestro</option>
                    <option value="Alumno">Alumno</option>
                </select>

                <input type="submit" class="form__button button submit" name="submit" value="Sign Up">
            </form>
            <div id="alertMessage" class="alert" style="display:none;"></div>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Welcome Back !</h2>
                <p class="switch__description description">Do you already have an account? Sign in HERE.</p>
                <a href="login.php"><button class="switch__button button switch-btn">SIGN IN</button></a>
            </div>
        </div>
    </div>

</body>
</html>

<?php
if(isset($_POST['submit']))
{
    $nombre = $_POST['nombres'];
    $correo = $_POST['correo'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $fecha_nac = $_POST['fecha_nac'];

    // Verificar longitud de contraseña
    if(strlen($contrasena) < 8) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "La contraseña debe tener al menos 8 caracteres"
                });
              </script>';
    } else {
        // Verificar coincidencia de edad y fecha de nacimiento
        $fecha_nac_timestamp = strtotime($fecha_nac);
        $edad_calculada = date('Y') - date('Y', $fecha_nac_timestamp);

        if ($edad_calculada != $edad) {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "La edad y la fecha de nacimiento no coinciden"
                    });
                  </script>';
        } else {
            // Procesar el registro
            require_once '../Conexion/contacto.php';
            $obj = new Contacto();
            $obj->crear_user($nombre, $edad, $correo, $genero, $contrasena, $tipo_usuario, $fecha_nac);

            // Mostrar mensaje de registro exitoso
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Registro exitoso!",
                        text: "Tu cuenta ha sido creada correctamente"
                    }).then(function() {
                        window.location = "login.php"; // Redirigir a la página de inicio de sesión
                    });
                  </script>';
        }
    }
}
?>

?>