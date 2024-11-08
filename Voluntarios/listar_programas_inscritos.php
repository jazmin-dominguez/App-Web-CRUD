<?php
//session_start();
require_once('../Conexion/contacto.php');

$obj = new Contacto();
$user_id = $_SESSION['user_id'];

// Obtener los programas en los que el usuario está inscrito
$programas = $obj->obtener_programas_inscritos($user_id);
?>

<div class="w-full h-full flex flex-col items-center">
    <h2 class="text-3xl font-bold mb-6 text-gray-700">Mis Programas Inscritos</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ml-8">
        <?php if (!empty($programas)): ?>
            <?php foreach($programas as $programa): ?>
                <div class="border-2 border-red-500 rounded-md p-4 text-center">
                    <img src="../SRC/icono-de-concepto-programas-educativos.webp" alt="Imagen del Programa" class="mx-auto mb-3" style="width: 150px; height: auto;" />
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars($programa['nombre']); ?></h3>
                    <p class="text-gray-700"><?php echo htmlspecialchars($programa['descripcion']); ?></p>
                    <p class="text-gray-500"><?php echo htmlspecialchars($programa['nombre_materia']); ?></p>
                    <p class="mt-4 px-4 py-2 bg-gray-400 text-white font-bold rounded-md cursor-not-allowed">Inscrito</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600">No estás inscrito en ningún programa.</p>
        <?php endif; ?>
    </div>
</div>
