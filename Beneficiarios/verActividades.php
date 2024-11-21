<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();

// Supongamos que el ID del usuario está almacenado en la sesión
$usuario_id = $_SESSION['user_id'];

// Obtener actividades según las materias inscritas
$result = $obj->obtener_actividades_por_usuario($usuario_id);

if ($result === false) {
    echo '<p class="text-center text-red-500">Error en la consulta a la base de datos.</p>';
} elseif (empty($result)) {
    echo '<p class="text-center text-red-500">No se encontraron actividades relacionadas con tus materias.</p>';
} else {
?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <div class="w-full h-full flex flex-col">
        <br>
        <br>
        <h1 class="text-center text-2xl font-semibold text-gray-700">Activities List</h1>
        
        
        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table id="activityTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Activity Name</th>
                            <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Description</th>
                            <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Subject</th>
                            <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Teacher</th>
                            <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($result as $row) { ?>
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_actividad'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300 max-w-md"><?php echo htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_materia'] ?? 'No asignado', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo isset($row['nombre_teacher']) ? htmlspecialchars($row['nombre_teacher'], ENT_QUOTES, 'UTF-8') : 'No asignado'; ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables
            $('#activityTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "dom": '<"flex justify-between items-center mb-4"l<"flex items-center"f>>rt<"flex justify-between items-center mt-4"ip>',
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search...",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    }
                }
            });
        });
    </script>
    <style>
    /* Estilo para el campo de búsqueda de DataTables */
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        width: 200px; /* Ajusta el tamaño aquí */
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }
    .dataTables_wrapper {
        overflow-y: hidden; /* Ocultar barra de desplazamiento vertical */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.75rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        
        font-size: 0.876rem;
        border: 1px solid #ddd;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #1d4ed8;
        color: white;
        font-weight: bold;
        border-color: #1d4ed8;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #e5e7eb;
    }
</style>
<?php } ?>
