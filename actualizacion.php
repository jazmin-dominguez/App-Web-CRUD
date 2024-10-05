<?php
include 'conexion.php'; 

// Verifica si se han enviado los datos 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $matricula = $_POST['matricula'];
    $nombres = $_POST['nombres'];
    $apellidopaterno = $_POST['apellidopaterno'];
    $apellidomaterno = $_POST['apellidomaterno'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $contrasena = $_POST['contrasena'];
    $confirmarcontrasena = $_POST['confirmarcontrasena'];

    // Verifica si las contraseñas coinciden
    if ($contrasena !== $confirmarcontrasena) {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Las contraseñas no coinciden. Por favor, verifica.'
        ));
        exit();
    }

    // Hashea la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta de actualización
    $stmt = $con->prepare("UPDATE Beneficiarios SET nombres = ?, apellidopaterno = ?, apellidomaterno = ?, correo = ?, edad = ?, contrasena = ? WHERE matricula = ?");
    $stmt->bind_param("sssssss", $nombres, $apellidopaterno, $apellidomaterno, $correo, $edad, $hashedPassword, $matricula);

    if ($stmt->execute()) {
        echo json_encode(array(
            'status' => 'success',
            'message' => 'Datos actualizados con éxito.'
        ));
    } else {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Error al actualizar los datos: ' . $stmt->error
        ));
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Beneficiary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
        }

        body {
            background: linear-gradient(
                90deg,
                rgba(245, 247, 248, 1) 25%,
                rgba(238, 238, 238, 1) 75%
            );
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .input-group input[type="text"],
        .input-group input[type="password"],
        .input-group input[type="email"],
        .input-group input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group input[type="text"]:focus,
        .input-group input[type="password"]:focus,
        .input-group input[type="email"]:focus,
        .input-group input[type="date"]:focus {
            border-color: #7d9c86;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #405047;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #859686;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Update Beneficiary Data</h2>
            <form id="updateForm" action="actualizacion.php" method="post">
                <div class="input-group">
                    <label for="matricula">Tuition:</label>
                    <input type="text" id="matricula" name="matricula" required>
                </div>
                <div class="input-group">
                    <label for="nombres">Names:</label>
                    <input type="text" id="nombres" name="nombres" required>
                </div>
                <div class="input-group">
                    <label for="apellidopaterno">Paternal Last Name:label>
                    <input type="text" id="apellidopaterno" name="apellidopaterno" required>
                </div>
                <div class="input-group">
                    <label for="apellidomaterno">Maternal Surname:</label>
                    <input type="text" id="apellidomaterno" name="apellidomaterno" required>
                </div>
                <div class="input-group">
                    <label for="correo">Email:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="input-group">
                    <label for="edad">Age:</label>
                    <input type="date" id="edad" name="edad" required>
                </div>
                <div class="input-group">
                    <label for="contrasena">Password:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="input-group">
                    <label for="confirmarcontrasena">Confirm Password:</label>
                    <input type="password" id="confirmarcontrasena" name="confirmarcontrasena" required>
                </div>
                <div class="input-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

