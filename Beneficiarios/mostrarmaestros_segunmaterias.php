<?php
// session_start();
require_once('../Conexion/contacto.php');

$obj = new Contacto();
$user_id = $_SESSION['user_id'];

// Obtener la información del maestro y materia según las materias inscritas por el usuario
$materias_info = $obj->obtener_maestro_y_materia_por_usuario($user_id);
?>
<br>
<br>
<div class="w-full h-full flex flex-col items-center">
    <h2 class="text-3xl font-bold mb-6 text-gray-700">Teacher Information</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ml-8">
        <?php if (!empty($materias_info)): ?>
            <?php foreach($materias_info as $info): ?>
                <div class="border-2 border-cyan-500 rounded-md p-4 text-center">
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars($info['nombre_materia']); ?></h3>
                    <p class="text-gray-500">Maestro: <?php echo htmlspecialchars($info['maestro_nombre']); ?></p>
                    <p class="text-gray-500">Correo: <?php echo htmlspecialchars($info['maestro_correo']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600">There is no teacher information available for the subjects you are enrolled in.</p>
        <?php endif; ?>
    </div>
</div>
