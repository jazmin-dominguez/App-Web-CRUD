<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

require_once("../Conexion/contacto.php");

// Verifica que el tipo de usuario esté en la sesión y asígnalo a la variable
$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'Desconocido';

$showForm = isset($_GET['action']) && $_GET['action'] == 'dashboard';
$showForm01 = isset($_GET['action']) && $_GET['action'] == 'mostrarmaestrossegunmaterias';
$showForm02 = isset($_GET['action']) && $_GET['action'] == 'crear_feedback';
$showForm06 = isset($_GET['action']) && $_GET['action'] == 'obtenerprogramassegunmateria';

$obj = new Contacto();

// Usamos el ID del usuario activo desde la sesión
$usuario_id = $_SESSION['user_id'];

// Crear objeto de la clase Contacto


// Consulta para obtener la información del usuario activo por su ID
$usuario_activo = $obj->obtener_usuario_por_id($usuario_id);  // Cambié de obtener_usuario_por_nombre a obtener_usuario_por_id

if (!$usuario_activo) {
    echo "Error: No se encontró información del usuario activo.";
    exit;
}

?>
<?php include '../funciones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php incluirWeglot(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Beneficiario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .submenu {
            display: none;
        }
        .dropdown.open .submenu {
            display: block;
        }
        .submenu2 {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 10;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 160px;
        }
        .dropdown:hover .submenu2 {
            display: block;
        }
        /* Mejor diseño para los botones del submenu2 */
        .submenu2 button, .submenu2 a {
            display: block;
            width: 100%;
            padding: 10px 16px;
            text-align: left;
            font-size: 14px;
            color: #555;
            background-color: #f9f9f9;
            border: none;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s, transform 0.2s;
        }
        .submenu2 button:hover, .submenu2 a:hover {
            background-color: #4a90e2;
            color: #fff;
            transform: translateY(-2px);
        }
        .submenu2 button:last-child, .submenu2 a:last-child {
            border-bottom: none;
        }
    </style>
    <script>
        function toggleMenu2(event) {
            const dropdown = event.currentTarget.parentNode;
            dropdown.classList.toggle('open');
        }
    
        function toggleMenu(event) {
            event.stopPropagation(); // Evita que el clic en el botón propague el evento
            const submenu = event.currentTarget.nextElementSibling;

            // Oculta cualquier otro submenu abierto
            document.querySelectorAll('.submenu2').forEach(el => {
                if (el !== submenu) {
                    el.classList.add('hidden');
                }
            });

            // Alterna el submenu actual
            submenu.classList.toggle('hidden');
        }

        // Cerrar el menú al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            if (!dropdown.contains(event.target)) {
                document.querySelectorAll('.submenu2').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });

        // Prevenir que el clic dentro del submenu cierre el menú
        document.querySelectorAll('.submenu2').forEach(submenu => {
            submenu.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen">
    <div class="flex h-full">
        <?php include('menu_lat.php'); ?>

        <main class="flex-grow ml-64">
            <!-- Encabezado con el Tipo de Usuario -->
            <header class="w-full bg-white py-4 px-6 flex justify-between items-center">
                <h1 class="text-2xl text-gray-700">Beneficiary Panel</h1>
                <div class="text-gray-700">
                    <div class="relative dropdown">
                        <button onclick="toggleMenu(event)" class="hover:underline focus:outline-none">
                            <p class="font-semibold"><?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($tipo_usuario); ?></p>
                        </button>
                        <div class="submenu2">
                            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Edit perfil</button>
                            <a href="../login/logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Log Out</a>
                        </div>
                    </div>
                </div>
            </header>

            <?php
                // Mostrar el panel de administración si no hay una acción específica seleccionada
                if (!$showForm && !$showForm01 && !$showForm02 && !$showForm06):
                    ?>
                    <div class="w-full h-full flex flex-col">
                        
                        <div class="flex-grow bg-gray-100 p-6">
                            <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                            <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                            <?php include('materias_disponibles.php'); ?>
                        </div>
                    </div>
                    <?php
                endif;
                if ($showForm):
                    ?>
                    <div class="w-full h-full flex flex-col">
                        
                        <div class="flex-grow bg-gray-100 p-6">
                            <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                            <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                            <?php include('materias_disponibles.php'); ?>
                        </div>
                    </div>
                    <?php
                endif;
                if($showForm01):
                    include('mostrarmaestros_segunmaterias.php');
                endif;
                if($showForm02):
                    include('crear_feedback.php');
                endif;
                if ($showForm06):
                    include('mostrar_programas_segunmaterias.php');
                endif;
                
                
                
            ?>
        </main>
        <div id="modal-editar" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-lg shadow-md w-full max-w-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-700">Editar Perfil</h2>
                    <form id="form-editar-usuario" class="space-y-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario_activo['nombre']); ?>" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div>
                            <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario_activo['correo']); ?>" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div>
                            <label for="fecha_nac" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nac" name="fecha_nac" value="<?php echo htmlspecialchars($usuario_activo['fecha_nac']); ?>" class="mt-1 block w-full rounded-md">
                        </div>
                        <div>
                            <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                            <select id="genero" name="genero" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="Masculino" <?php echo $usuario_activo['genero'] == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                <option value="Femenino" <?php echo $usuario_activo['genero'] == 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="cancelar" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
       function openModal() {
            document.getElementById('modal-editar').classList.remove('hidden');
        }
    
        document.getElementById('cancelar').addEventListener('click', function() {
            document.getElementById('modal-editar').classList.add('hidden');
        });
    
    
    // Inicializar la edad al cargar la página
    window.addEventListener('DOMContentLoaded', (event) => {
        const fechaInput = document.getElementById('fecha_nac');
        if (fechaInput.value) {
            const eventInput = new Event('input');
            fechaInput.dispatchEvent(eventInput);
        }
    });
    
    
        // SweetAlert2 para guardar cambios
        document.getElementById('form-editar-usuario').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
    
            try {
                const response = await fetch('actualizar_perfil.php', {
                    method: 'POST',
                    body: formData
                });
    
                const data = await response.text();
    
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Cambios guardados!',
                        text: 'Tus datos han sido actualizados con éxito.',
                        confirmButtonColor: '#4a90e2'
                    }).then(() => {
                        location.reload(); // Recargar página para reflejar cambios
                    });
    
                    // Actualizar datos en la página dinámicamente
                    document.querySelector('.font-semibold').textContent = formData.get('nombre');
                    document.getElementById('modal-editar').classList.add('hidden');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudieron guardar los cambios.',
                        confirmButtonColor: '#d33'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un problema al enviar la solicitud.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    
    </script>
</body>
</html>
