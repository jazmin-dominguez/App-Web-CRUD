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
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            
                            <th class="w-1/4 px-6 py-3 text-center text-sm font-medium text-gray-700 border-b border-gray-300"">Subject Name</th>
                            <th class="w-1/2 px-6 py-3 text-center text-sm font-medium text-gray-700 border-b border-gray-300"">Objectives</th>
                            <th class="w-1/4 px-6 py-3 text-center text-sm font-medium text-gray-700 border-b border-gray-300"">Activities</th>
                            
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                
                                <td class="w-1/4 px-6 py-4  text-sm text-gray-800 align-top break-words border-b border-gray-300"><?php echo htmlspecialchars($row["nombre_materia"] ?? ''); ?></td>
                                <td class="w-1/2 px-6 py-4 text-sm text-gray-800 align-top break-words border-b border-gray-300"><?php echo htmlspecialchars($row["objetivos"] ?? ''); ?></td>
                                <td class="w-1/4 px-6 py-4 text-sm text-gray-800 align-top break-words border-b border-gray-300"><?php echo htmlspecialchars($row["actividades"] ?? ''); ?></td>
                                
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
