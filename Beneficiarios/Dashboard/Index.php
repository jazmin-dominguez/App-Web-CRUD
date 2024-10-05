<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Khan Academy</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <h1>Hola <span id="user-name">Usuario</span></h1>
    </div>
    
    <nav>
        <div class="menu">
            <button class="menu-button">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>
            <div class="menu-content">
                <a href="">Actualizar mis datos</a>
                <a href="">Mis cursos</a>
                <a href="">Mis profes</a>
                <a href="">Calificar</a>
            </div>
        </div>
    </nav>

    <div class="header2">
        <h1>Mis cursos:</h1>
    </div>

    <div class="courses">
        <div class="course-card">
            <div class="course-icon">🔢</div>
            <div class="course-info">
                <h2>Matemáticas</h2>
                <p>Docente: Juan Pablo Vargas</p>
                <div class="status-bar">
                    <div class="status-completed" style="width: 30%;"></div>
                </div>
                <p>Estado: Iniciado 30%</p>
                <button>Continuar</button>
            </div>
        </div>

        <div class="course-card">
            <div class="course-icon">🖥️</div>
            <div class="course-info">
                <h2>Computación</h2>
                <p>Docente: Jesús Emilio Ballinas</p>
                <div class="status-bar">
                    <div class="status-completed" style="width: 75%;"></div>
                </div>
                <p>Estado: Iniciado 75%</p>
                <button>Continuar</button>
            </div>
        </div>

        <div class="course-card">
            <div class="course-icon">🔤</div>
            <div class="course-info">
                <h2>Inglés</h2>
                <p>Docente: Ana Magali Moreno</p>
                <div class="status-bar">
                    <div class="status-completed" style="width: 18%;"></div>
                </div>
                <p>Estado: Iniciado 18%</p>
                <button>Continuar</button>
            </div>
        </div>

        <div class="course-card">
            <div class="course-icon">💾</div>
            <div class="course-info">
                <h2>Base de Datos</h2>
                <p>Docente: Enrique Carlos Busquets</p>
                <div class="status-bar">
                    <div class="status-completed" style="width: 100%;"></div>
                </div>
                <p>Estado: Terminado</p>
                <button>Opinar</button>
            </div>
        </div>
    </div>

    <footer1>
        <h1> <br> </h1>
    </footer1>

    <footer>
        <p>© Copyright 2024 Unity Class | Khan Academy</p>
    </footer>

    <script>
        // Para cambiar el nombre por el nombre del usuario ingresado
        const userName = prompt("Por favor, dinos como quieres que te llamemos:", "");
        document.getElementById('user-name').textContent = userName;
    </script>
</body>

</html>
