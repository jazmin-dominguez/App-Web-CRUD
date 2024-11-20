<?php
// Incluir la conexión a la base de datos y la clase Contacto
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$activities = $obj->obtenerActividades(); // Función que ya retorna los datos en un array asociativo

if ($activities === false) {
    echo '<p class="text-center text-red-500">Error en la consulta a la base de datos.</p>';
} elseif (empty($activities)) {
    echo '<p class="text-center text-red-500">No activities found.</p>';
} else {
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<div class="w-full h-full flex flex-col">
    <br>
    <br>
    <h1 class="text-2xl font-semibold text-gray-700">List of Activities</h1>
    
    <div class="flex-grow bg-gray-100 p-6">
        <div class="overflow-x-auto">
            <table id="activitiesTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg font-Jost">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Activity Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Description</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Date</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Subject</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Teacher</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($activities as $activity) { ?>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['actividad_id']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['nombre_actividad']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['descripcion']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['fecha']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['nombre_materia']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($activity['nombre_teacher']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#activitiesTable').DataTable({
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
        width: 200px;
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
        font-size: 0.875rem;
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

<?php
}
?>
