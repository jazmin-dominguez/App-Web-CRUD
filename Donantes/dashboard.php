<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Donantes</title>

    <!-- Remix Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"/>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Estilo general */
        body {
            font-family: Arial, sans-serif;
            background-color: #E6F2FF;
            color: #333;
            margin: 0;
        }

        /* Estilo para el header */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            background-color: rgba(22, 78, 99, 0.9); 
            transition: background-color 0.3s;
        }

        .nav-link {
            color: #FFF;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #FFC300;
        }

        /* Estilo para el enlace activo */
        .active-link {
            color: #FFC300 !important;
        }

        /* Menú responsive */
        #nav-menu {
            transition: left 0.3s ease-in-out;
        }

        /* Botón hamburguesa */
        .hamburger {
            cursor: pointer;
        }

        /* Logo y título */
        .logo {
            font-family: 'Lobster', cursive;
            font-size: 1.5rem;
            color: #FFF;
            transition: color 0.3s;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header id="navbar" class="fixed w-full top-0 left-0 z-50 bg-[#164E63]">
    <nav class="container flex items-center justify-between h-16 sm:h-20">
        <!-- Logo -->
        <div class="logo">Unity Class</div>

        <!-- Menú -->
        <div id="nav-menu" class="absolute top-0 left-[-100%] min-h-[80vh] w-full bg-transparent backdrop-blur-sm flex items-center justify-center duration-300 overflow-hidden lg:static lg:min-h-fit lg:bg-transparent lg:w-auto">
            <ul class="flex flex-col items-center gap-8 lg:flex-row">
                <li><a href="#information" class="nav-link" data-section="information">Information</a></li>
                <li><a href="#donations" class="nav-link" data-section="donations">Donations</a></li>
                <li><a href="#contact" class="nav-link" data-section="contact">Contact</a></li>

                <!-- Botón de Logout, visible solo si el usuario ha iniciado sesión -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <form action="../login/logout.php" method="POST">
                            <button type="submit" class="nav-link font-bold">Logout</button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Botón hamburguesa -->
        <div class="text-xl sm:text-3xl hamburger lg:hidden" id="hamburger">
            <i class="ri-menu-4-line"></i>
        </div>
    </nav>
</header>

<!-- Contenido principal -->
<main class="pt-20">
    <!-- Sección de Información -->
    <section id="information" class="h-screen text-white flex flex-col items-center justify-center" style="background-color: #164E63;">
        <h1 class="text-4xl font-bold mb-4">INFORMATION</h1>
        <p class="text-xl">Explore our reports to see how your contributions are changing lives.</p>
    </section>

    <!-- Sección de Donaciones -->
    <section id="donations" class="h-screen text-black flex flex-col items-center justify-center" style="background-color: #5BA0B3;">
        <h1 class="text-4xl font-bold mb-4">DONATIONS</h1>
        <p class="text-xl">Make a donation and help us make a difference!</p>
    </section>

    <!-- Sección de Contacto -->
    <section id="contact" class="h-screen text-white flex flex-col items-center justify-center" style="background-color: #0F758C;">
        <h1 class="text-4xl font-bold mb-4">CONTACT</h1>
        <p class="text-xl">Get in touch with us for any inquiries or support.</p>
    </section>
</main>

<!-- Footer -->
<footer class="bg-yellow-100 text-cyan-950 pt-20 pb-10 md:pt-28 relative">
    <!-- Content -->
    <div class="footer__content container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 text-center md:text-start">
        <!-- Item 1 -->
        <div>
            <div class="text-7xl text-cyan-700 text-center inline-block">
                <i class="ri-leaf-fill"></i>
                <p class="font-Lobster text-xl sm:text-2xl">UnityClass</p>
            </div>
        </div>

        <!-- Item 2 -->
        <div>
            <p class="mb-5 font-bold text-xl">Quick Link</p>
            <div class="flex flex-col gap-1">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="login/login.php">Login</a>
                <a href="#Popular">Popular</a>
                <a href="#review">Review</a>
            </div>
        </div>

        <!-- Item 3 -->
        <div>
            <p class="mb-5 font-bold text-xl">Popular services</p>
            <div class="flex flex-col gap-1">
                <a href="#">Programs</a>
                <a href="#">Courses</a>
                <a href="#">Activities</a>
                <a href="#">Reviews</a>
            </div>
        </div>

        <!-- Item 4 -->
        <div>
            <p class="mb-5 font-bold text-xl">Contact Us</p>
            <div class="flex flex-col gap-1">
                <a href="tel:+523131388210">+52 313 138 82 10</a>
                <a href="mailto:classunity115@gmail.com">classunity115@gmail.com</a>
                <p>Manzanillo, Colima, Mexico</p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copy__right container">
        <p class="text-center mt-10 opacity-50">Copyright &copy; 2024 UnityClass. All rights reserved.</p>
    </div>
</footer>

<!-- Scroll up -->
<a href="#" class="fixed right-4 -bottom-1/2 bg-yellow-500 shadow-sm inline-block px-3 py-1 md:px-4 md:py-2 rounded-md text-lg z-50 hover:-translate-y-1 duration-300" id="scroll-up">
    <i class="ri-arrow-up-line"></i>
</a>

<!-- JavaScript para cambiar el color del enlace activo en el header -->
<script>
    const navbar = document.getElementById('navbar');
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    // Función para actualizar el enlace activo según la sección visible
    function updateActiveLink() {
        let currentSection = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 70;
            if (window.scrollY >= sectionTop) {
                currentSection = section.getAttribute('id');
            }
        });

        // Cambiar el color del enlace de la sección actual
        navLinks.forEach(link => {
            link.classList.remove('active-link');
            if (link.getAttribute('data-section') === currentSection) {
                link.classList.add('active-link');
            }
        });
    }

    // Llamar a la función cuando la página se carga
    document.addEventListener('DOMContentLoaded', updateActiveLink);

    // Actualizar el enlace activo al hacer scroll
    window.addEventListener('scroll', updateActiveLink);

    // Menú hamburguesa
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');
    
    hamburger.addEventListener('click', () => {
        navMenu.style.left = (navMenu.style.left === '0px') ? '-100%' : '0';
    });
</script>

</body>
</html>
