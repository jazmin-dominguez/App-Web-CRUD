<?php
  session_start();
  if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
  }

  $showForm = isset($_GET['action']) && $_GET['action'] == 'dashboard';
  $showForm0 = isset($_GET['action']) && $_GET['action'] == 'crearusuario';
  $showForm1 = isset($_GET['action']) && $_GET['action'] == 'listarusuarios';
  $showForm2 = isset($_GET['action']) && $_GET['action'] == 'modificarusuario';
  $showForm3 = isset($_GET['action']) && $_GET['action'] == 'eliminarusuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Administrativo</title>
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
        <?php
            if (!$showForm && !$showForm0 && !$showForm1 && !$showForm2 && !$showForm3):
                ?>
                <div class="w-full h-full flex flex-col">
                    <header class="w-full bg-white py-4 px-6">
                        <h1 class="text-2xl text-gray-700">Administration Panel</h1>
                    </header>
                    <div class="flex-grow bg-gray-100 p-6">
                        <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                        <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                    </div>
                </div>
                <?php
            endif;
            if ($showForm):
                ?>
                <div class="w-full h-full flex flex-col">
                    <header class="w-full bg-white py-4 px-6">
                        <h1 class="text-2xl text-gray-700">Administration Panel</h1>
                    </header>
                    <div class="flex-grow bg-gray-100 p-6">
                        <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                        <p class="text-gray-600 mt-2">Select an option from the menu to begin.</p>
                    </div>
                </div>
                <?php
            endif;
            if ($showForm0):
                include('crearusuario.php');
            endif;
            if ($showForm1):
                include('listar_usuario.php');
            endif;
            if ($showForm2):
                include('modicar_usuario.php');
            endif;
            if ($showForm3):
                include('eliminar_usuario.php');
            endif;
        ?>
    </main>
  </div>
</body>
</html>
