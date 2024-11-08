<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
    exit();
}
// Verifica que el tipo de usuario esté en la sesión y asígnalo a la variable
$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'Desconocido';

$showForm = isset($_GET['action']) && $_GET['action'] == 'dashboard';
$showForm0 = isset($_GET['action']) && $_GET['action'] == 'crearactividad';
$showForm1 = isset($_GET['action']) && $_GET['action'] == 'listaractividades';
$showForm2 = isset($_GET['action']) && $_GET['action'] == 'modificaractividad';
$showForm3 = isset($_GET['action']) && $_GET['action'] == 'eliminaractividad';
$showForm11 = isset($_GET['action']) && $_GET['action'] == 'listarprogramasinscritos';
?>
<?php include '../funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php incluirWeglot(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Teacher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .submenu {
            display: none;
        }
        .dropdown.open .submenu {
            display: block;
        }
    </style>
    <script>
        function toggleMenu(event) {
            const dropdown = event.currentTarget.parentNode;
            dropdown.classList.toggle('open');
        }
    </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen">
    <div class="flex h-full">
        <?php include('menu_lat.php'); ?>

        <main class="flex-grow ml-64">
        <!-- Encabezado con el Tipo de Usuario -->
            <header class="w-full bg-white py-4 px-6 flex justify-between items-center">
                <h1 class="text-2xl text-gray-700">Volunteer Panel</h1>
                <div class="text-gray-700">
                <a href="../login/logout.php" class="hover:underline">
                    <p class="font-semibold"><?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($tipo_usuario); ?></p> <!-- Tipo de usuario -->
                </a>
                </div>
            </header>

            <?php
            if (!$showForm && !$showForm0 && !$showForm1 && !$showForm2 && !$showForm11):
                ?>
                <div class="w-full h-full flex flex-col">
                    
                    <div class="flex-grow bg-gray-100 p-6">
                        <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                        <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                        <?php include('programas_disponibles.php'); ?>
                    </div>
                </div>
                <?php
            elseif ($showForm):
                ?>
                <div class="w-full h-full flex flex-col">
                    
                    <div class="flex-grow bg-gray-100 p-6">
                        <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                        <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                        <?php include('programas_disponibles.php'); ?>                   
                    </div>
                </div>
                <?php
            endif;
            if ($showForm0):
                include('crearactividad.php');
            endif;
            if ($showForm1):
                include('listar_actividades.php');
            endif;
            if ($showForm2):
                include('modificar_actividad.php');
            endif;
            if ($showForm11):
                include('listar_programas_inscritos.php');
            endif;
            ?>
        </main>
    </div>
</body>
</html>
