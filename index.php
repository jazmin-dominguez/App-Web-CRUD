<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form class="form" id="registrationForm" method="POST">
                <h2 class="form_title title">Create Account</h2>
                <input class="form__input" type="text" name="matricula" placeholder="AccNumber">
                <input class="form__input" type="text" name="nombres" placeholder="Name">
                <input class="form__input" type="text" name="apellidopaterno" placeholder="PaternalSurname">
                <input class="form__input" type="text" name="apellidomaterno" placeholder="MaternalSurname">
                <input class="form__input" type="text" name="correo" placeholder="Correo">
                <input class="form__input" type="date" name="edad" placeholder="Birthday">
                <input class="form__input" type="password" name="contrasena" placeholder="Password">
                <input class="form__input" type="password" name="confirmarcontrasena" placeholder="PaswordConfirmation">
                <button class="form__button button submit" id="submit">SIGN UP</button>
            </form>
            <div id="alertMessage" class="alert" style="display:none;"></div>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Welcome Back !</h2>
                <p class="switch__description description">do you already have an account? Sign in HERE.</p>
                <button class="switch__button button switch-btn">SIGN IN</button>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
    <script src="./script.js"></script>
    <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('registro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request.',
            });
        });
    });
</script>

</body>
</html>
