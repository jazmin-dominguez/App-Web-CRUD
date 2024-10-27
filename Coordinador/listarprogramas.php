<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_programas();

if ($result === false) {
    echo '<p class="text-center text-red-500">Error en la consulta a la base de datos.</p>';
} elseif ($result->num_rows === 0) {
    echo '<p class="text-center text-red-500">No se encontraron programas.</p>';
} else {
    ?>
    <div class="w-full h-full flex flex-col">
        <header class="w-full bg-white py-4 px-6 shadow-md mb-4">
            <h1 class="text-2xl font-semibold text-gray-700">List of Programs</h1>
        </header>
        
        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table id="programTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gray-200 text-black uppercase text-sm leading-normal ">
                        <tr>
                            <th class="px-4 py- border border-gray-300 text-blue-800">Name</th>
                            <th class="px-4 py-2 border  border-gray-300 text-blue-800">Description</th>
                            <th class="px-4 py-2 border  border-gray-300 text-blue-800">Subject</th>
                            <th class="px-4 py-2 border  border-gray-300 text-blue-800">Name Teacher</th>
                            <th class="px-4 py-2 border  border-gray-300 text-blue-800">User Type</th>
                            <th class="px-4 py-2 border border-gray-300 text-center text-blue-800">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-black-700 text-sm font-light">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row['programa_nombre']); ?></td>
                                <td class="px-4 py-2 border border-gray-300 max-w-md"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row['nombre_materia']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row['tipo_usuario']); ?></td>
                                
                                <td class="px-4 py-2 border-b border-gray-300 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="modificarprograma.php?id=<?php echo !empty($row['id']) ? urlencode($row['id']) : '#'; ?>" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"><i class="fas fa-edit"></i></a>
                                        <a href="eliminar_programa.php?id=<?php echo !empty($row['id']) ? urlencode($row['id']) : '#'; ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('¿Estás seguro de que deseas eliminar este programa?');"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- Incluye las bibliotecas de DataTables y ajusta el estilo del buscador y la paginación -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#programTable').DataTable({
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
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.75rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        color: #4b5563;
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
        color: #111827;
    }
</style>