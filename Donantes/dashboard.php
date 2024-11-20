<?php
session_start();
include '../Conexion/contacto.php'; // Asegúrate de que esta ruta es correcta

// Crear una instancia de la clase Contacto
$contacto = new Contacto();

// Obtener los programas usando el método de la clase Contacto
$result = $contacto->listar_programas();
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
        <div class="container w-full grid grid-cols-1 gap-x-8 gap-y-36 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            
            <?php while ($row = $result->fetch_assoc()): ?>
                <!-- Tarjeta de Programa -->
                <div class="popular_card bg-cyan-950 p-10 pt-24 rounded-md relative">
                    <!-- Imagen del programa -->
                    <img src="../SRC/2654513.png" alt="program_image" class="w-52 absolute -top-5 left-1/2 transform -translate-x-1/2 -translate-y-1/2 duration-500">
                    
                    <h3 class="italic mt-5"><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($row['descripcion']); ?></p>

                    <div class="text-yellow-500 text-xs py-3">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                        <i class="ri-star-line text-gray-400"></i>
                        <i class="ri-star-line text-gray-400"></i>
                    </div>

                    <!-- Enlace para ver más detalles -->
                    <a href="programa_detalle.php?id=<?php echo $row['id']; ?>" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Ver más</a>
                </div>
            <?php endwhile; ?>
            
        </div>
    </section>
</main>

</body>
</html>
<!-- Sección de Historial de Donaciones -->
<section id="historial_donaciones" class="relative flex flex-col items-center justify-center h-screen bg-blue-100 text-gray-900">
    <h1 class="text-4xl font-bold mb-4 flex items-center text-cyan-800">
        <i class="ri-money-dollar-circle-fill mr-2 text-yellow-500"></i> <!-- Icono de dinero -->
        Donation History
    </h1>
    <p class="text-lg mb-4 text-cyan-700">Here you can see the history of all your donations made.</p>
    
    <!-- Consulta y visualización del historial de donaciones -->
    <div class="container mx-auto px-4">
        <?php
        // Obtener el historial de donaciones usando el método de la clase Contacto
        $historial = $contacto->listar_historial_donaciones(); 
        if ($historial->num_rows > 0): ?>
            <!-- Contenedor scrollable -->
            <div class="max-h-96 overflow-y-auto border rounded-lg shadow-lg">
                <table class="w-full text-left bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-cyan-800 text-black">
                            <th class="px-4 py-2">Donation date</th>
                            <th class="px-4 py-2">Donor Name</th>
                            <th class="px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($donacion = $historial->fetch_assoc()): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($donacion['fecha_donacion']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($donacion['nombre_donacion']); ?></td>
                                <td class="px-4 py-2"><?php echo "$" . number_format($donacion['monto'], 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-700">No hay donaciones registradas.</p>
        <?php endif; ?>
    </div>
</section>





    <!-- Sección de Donaciones -->
    <section id="donaciones" class="relative flex items-center justify-center h-screen bg-blue-900 text-white" style="background-color: #5EA2B5;">
    <!-- Imagen izquierda -->
    <img src="../SRC/hero_student_collage_US_1x.png" alt="Imagen Estudiante" class="absolute left-0 top-1/2 transform -translate-y-1/2 max-w-xs opacity-70" style="margin-left: 20px;">

    <div id="form-container" style="width: 100%; max-width: 800px; padding: 20px; text-align: center;">
        <!-- Formulario que envía datos a guardar_donacion.php -->
        <form id="donation-form" action="guardar_donacion.php" method="POST">
            <!-- Welcome Step -->
            <div id="step-welcome" class="form-step active">
                <h2 class="text-center">Help us provide education and support to vulnerable children.</h2>
                <p class="text-center mb-8">Your donation will be completely tax deductible.</p>
                <button type="button" class="button" onclick="nextStep()">Donate</button>
            </div>

            <!-- Name Step -->
            <div id="step-name" class="form-step hidden">
                <p class="question">Card Holders Name</p>
                <input type="text" id="first-name" name="nombre_donacion" class="input-field" placeholder="Your name" required>
                <button type="button" class="button" onclick="nextStep()">Accept</button>
            </div>

        
            <!-- Amount Step -->
            <div id="step-amount" class="form-step hidden">
                <p class="question">How much would you like to donate <span id="display-name"></span>?</p>
                <div id="amount-options">
                    <span class="option-button" onclick="selectAmount(25)">$25</span>
                    <span class="option-button" onclick="selectAmount(50)">$50</span>
                    <span class="option-button" onclick="selectAmount(100)">$100</span>
                    <span class="option-button" onclick="selectAmount(150)">$150</span>
                    <span class="option-button" onclick="selectAmount(200)">$200</span>
                </div>
                <input type="hidden" name="monto" id="monto_donacion">
                <button type="button" class="button" onclick="nextStep()">Accept</button>
            </div>

            <!-- Contact Step -->
            <div id="step-contact" class="form-step hidden">
                <p class="question">Please enter your email</p>
                <input type="email" id="email" name="email" class="input-field" placeholder="Email" required>
                <button type="button" class="button" onclick="nextStep()">Accept</button>
            </div>

            <!-- Payment Step -->
            <div id="step-payment" class="form-step hidden">
                <p class="question">Confirm your donation <span id="confirm-amount"></span> USD</p>
                <input type="text" id="card-number" class="input-field" placeholder="Card number" maxlength="19" required>
                <input type="text" id="expiry-date" class="input-field" placeholder="Due Date (MM/YY)" maxlength="5" required>
                <input type="text" class="input-field" placeholder="CVC" maxlength="3" required>
                <input type="hidden" name="fecha_donacion" id="fecha_donacion" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="FK_tipo_Usuario" value="1"> <!-- Ajusta según corresponda -->
                <button type="submit" class="button">Send</button>
            </div>

            <!-- Thank You Step -->
            <div id="step-thank-you" class="form-step hidden">
                <h2>¡Gracias!</h2>
                <p>Muchas gracias por tu donación, <span id="thank-name"></span>. Tu contribución marcará la diferencia.</p>
                <button type="button" class="button" onclick="resetForm()">Volver al inicio</button>
            </div>
        </form>
    </div>

    <!-- Imagen derecha -->
    <img src="../SRC/desktop_77e774f8-a8db-4a84-a2f4-a09bd867809c.png" alt="Imagen Niño" class="absolute right-0 top-1/2 transform -translate-y-1/2 max-w-xs opacity-70" style="margin-right: 20px;">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap');

        body, .form-step {
            font-family: 'League Spartan', sans-serif;
        }
        
        .form-step {
            display: none;
            text-align: center;
            padding: 20px;
            transition: opacity 0.3s ease;
        }
        .form-step.active {
            display: block;
        }
        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .button {
            background-color: #ffcc00;
            color: black;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.5rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #e6b800;
        }
        .input-field {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            color: black;
        }
        .question {
            font-size: 1.8rem;
            margin: 20px 0;
        }
        .option-button {
            display: inline-block;
            background-color: #004080;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            transition: background-color 0.3s ease;
        }
        .option-button.selected {
            background-color: #ffcc00;
            color: black;
        }
    </style>

    <script>
        let currentStep = 0;
        let selectedAmount = 0;

        function nextStep() {
            const steps = document.querySelectorAll('.form-step');
            const currentElement = steps[currentStep];
            let valid = true;
            const inputs = currentElement.querySelectorAll("input[required]");
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.reportValidity(); 
                    valid = false;
                }
            });

            if (!valid) return;

            steps[currentStep].classList.remove('active');
            currentStep++;
            steps[currentStep].classList.add('active');
            
            if (currentStep === 3) {
                const firstName = document.getElementById('first-name').value;
                document.getElementById('display-name').textContent = firstName;
                document.getElementById('thank-name').textContent = firstName;
            }
        }

        function selectAmount(amount) {
            selectedAmount = amount;
            document.querySelectorAll('.option-button').forEach(button => button.classList.remove('selected'));
            event.target.classList.add('selected');
            document.getElementById('monto_donacion').value = amount;
            document.getElementById('confirm-amount').textContent = amount;
        }

        function resetForm() {
            document.querySelectorAll('.form-step').forEach(step => step.classList.remove('active'));
            document.getElementById("step-welcome").classList.add('active');
            currentStep = 0;
        }

        // Formato para número de tarjeta
        const cardNumberInput = document.getElementById('card-number');
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = value;
        });

        cardNumberInput.addEventListener('keydown', function(e) {
            if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Tab') {
                e.preventDefault();
            }
        });

        // Formato para fecha de vencimiento
        const expiryDateInput = document.getElementById('expiry-date');
        expiryDateInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });

        expiryDateInput.addEventListener('keydown', function(e) {
            if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Tab') {
                e.preventDefault();
            }
        });
    </script>
</section>

<!-- Sección de Contacto -->
<section id="contact" class="h-screen text-white flex flex-col items-center justify-center" style="background-color: #0F758C;">
    <h1 class="text-4xl font-bold mb-4">CONTACT</h1>
    <p class="text-xl mb-6">Get in touch with us for any inquiries or support.</p>

    <!-- Formulario de contacto -->
    <div class="container mx-auto px-4 max-w-lg">
        <form method="POST" class="bg-white p-6 rounded-lg shadow-md text-gray-900">
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg" placeholder="Your Name" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Your Email" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-bold mb-2">Message</label>
                <textarea name="message" id="message" class="w-full px-3 py-2 border rounded-lg" placeholder="Your Message" rows="4" required></textarea>
            </div>
            <button type="submit" name="enviar" class="bg-black text-white py-2 px-4 border rounded-lg hover:bg-cyan-700 font-bold">Send Message</button>
            <?php
                if(isset($_POST["enviar"])) {
                    $contenido = $_POST['message'];
                    include ("sendmail.php");
                }
            ?>
        </form>
    </div>
</section>


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
