<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la conexión a la base de datos
require_once '../Conexion/conexion.php';


$conexion = new Conexion();


$query = "SELECT * FROM materias";
$conexion->sentencia = $query;


$result = $conexion->obtener_sentencia();
?>

<?php if ($result && $result->num_rows > 0): ?>
    <div class="w-full h-full flex flex-col">
        <header class="w-full bg-white py-4 px-6">
            <h1 class="text-2xl text-gray-700">List of Subjects</h1>
        </header>
        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b border-gray-300">ID</th>
                            <th class="px-4 py-2 border-b border-gray-300">Subject Name</th>
                            <th class="px-4 py-2 border-b border-gray-300">Objectives</th>
                            <th class="px-4 py-2 border-b border-gray-300">Activities</th>
                            <th class="px-4 py-2 border-b border-gray-300">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row["id"] ?? ''); ?></td>
                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row["nombre_materia"] ?? ''); ?></td>
                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row["objetivos"] ?? ''); ?></td>
                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row["actividades"] ?? ''); ?></td>
                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row["unidad"] ?? ''); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="text-center text-red-500">No subjects were found or there was an error in the query.</p>
<?php endif; ?>
