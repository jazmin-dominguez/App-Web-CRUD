<?php
//session_start(); // Iniciar sesión

// Simulamos que ya está guardado el nombre del usuario en la sesión
// En tu caso, esto lo obtienes después del login
//if (isset($_SESSION['nombre_usuario'])) {
  //  $nombreVoluntario = $_SESSION['nombre_usuario']; // Obtener el nombre del voluntario de la sesión
//} else {
    // Redirigir al usuario al login si no está autenticado
  //  header('Location: login.php');
    //exit;
//}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio del Voluntario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo de estilos CSS -->
    
</head>

<body>
    <header class="main-header">
        <div class="logo">
            <img src="../img/WhatsApp Image 2024-09-04 at 9,55,54 PM_processed.jpeg" alt="Logo de la ONG">
            <span>Unity Class </span>
        </div>
        <h1>Welcome, <?php //echo htmlspecialchars($nombreVoluntario); ?>!</h1> <!-- Mostrar el nombre del voluntario -->
        <a href="logout.php" class="btn-logout">Sign Out</a>
    </header>

    <div class="container">
        <aside class="sidebar">

            <nav class="nav">
                <ul class="list">

                    <li class="list__item">
                        <div class="list__button">
                            <img src="assets/inicio.svg" class="list__img" >
                            <a href="#" class="nav__link">Home</a>
                        </div>
                    </li>

                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/registro.svg" class="list__img">
                            <a href="#" class="nav__link">Activity Log</a>
                            <img src="assets/flecha.svg" class="list__arrow">
                        </div>

                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="./RegistrodeActividad/RegistroForm.php" class="nav__link nav__link--inside">Registration Form</a>
                            </li>

                            <li class="list__inside">
                                <a href="historial_Act.php" class="nav__link nav__link--inside">Activity History</a>
                            </li>

                            <li class="list__inside">
                                <a href="#" class="nav__link nav__link--inside">Automatic Requirements</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!--<li class="list__item">
                        <div class="list__button">
                            <img class="list__img" src="assets/actualizar.svg" alt="">
                            <a href="#">Actualizacion de Tareas</a>
                        </div>
                    </li> -->

                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/registro.svg" class="list__img">
                            <a href="#" class="nav__link">Task Update</a>
                            <img src="assets/flecha.svg" class="list__arrow">
                        </div>

                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="./Actualizacion de act (Ingles)/index.php" class="nav__link nav__link--inside">Tasks</a>
                            </li>

                            <li class="list__inside">
                                <a href="#" class="nav__link nav__link--inside">Task Status</a>
                            </li>

                            <li class="list__inside">
                                <a href="#" class="nav__link nav__link--inside">Priority & Reminders</a>
                            </li>

                            <li class="list__inside">
                                <a href="#" class="nav__link nav__link--inside">Comments & Notes</a>
                            </li>
                        </ul>

                    </li>

                    <li class="list__item">
                        <div class="list__button">
                            <img class="list__img" src="assets/mensaje.svg">
                            <a href="#" class="nav__link">Contact </a>
                        </div>
                    </li>

                </ul>
            </nav>

            <!--<button>Coordinadores</button>
            <button>Voluntarios</button> -->
        </aside>

        <main class="content">
            <section class="profile">
                <div class="profile-pic">
                    <img src="../img/avatar-3.png" alt="Foto del voluntario">
                </div>
                <!--<h2><?php //echo htmlspecialchars($nombreVoluntario); ?></h2> -->
                <div class="bio">
                    <p>Pedro Jimenez Hernandez</p>
                    <!--<p>Bibliografía</p>-->
                </div>
            </section>

            <section class="skills">
                <h3>Subjects</h3>
                <ul>
                    <li>Matematicas</li>
                    <li>Geografia</li>
                    <li>Historia</li>
                </ul>
            </section>
        </main>
    </div>

    
            <?php //include '../footer.php' ; ?>
            <script src="main.js"></script>
</body>
</html>
