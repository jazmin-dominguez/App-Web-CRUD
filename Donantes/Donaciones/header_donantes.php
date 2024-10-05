<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            text-decoration: none;
            list-style: none;
        }

        .header {
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 4px 20px #4F6652;
            background-color: #4F6652;
            z-index: 1;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .logo a span {
            color: #8739fa;
        }

        .menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu a {
            display: block;
            padding: 7px 15px;
            font-size: 17px;
            font-weight: 500;
            transition: 0.2s all ease-in-out;
            color: #fff;
        }

        .menu:hover a {
            opacity: 0.4;
        }

        .menu a:hover {
            opacity: 1;
            color: #fff;
        }

        .menu-icon {
            display: none;
        }

        #menu-toggle {
            display: none;
        }

        #menu-toggle:checked ~ .menu {
            transform: scale(1, 1);
        }

        @media only screen and (max-width: 950px) {
            .menu {
                flex-direction: column;
                background-color: #151418;
                align-items: start;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                z-index: 1;
                transform: scale(1, 0);
                transform-origin: top;
                transition: transform 0.3s ease-in-out;
                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            }

            .menu a {
                margin-left: 12px;
            }

            .menu li {
                margin-bottom: 10px;
            }

            .menu-icon {
                display: block;
                color: #fff;
                font-size: 28px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <nav>
        <div class="logo">
            <a href="#">Donors</a>
        </div>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon">&#9776;</label>
        <ul class="menu">
            <li><a href="../../index.php" onclick="showSection('activity-history')">Exit</a></li>
            
        </ul>
    </nav>
</header>

<script>
    function showSection(sectionId) {
        // Ocultar todas las secciones
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });

        // Mostrar la sección seleccionada
        document.getElementById(sectionId).style.display = 'block';
    }
</script>

</body>
</html>
