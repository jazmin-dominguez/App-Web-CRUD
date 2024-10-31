<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_usuarios();

if ($result && $result->num_rows > 0) {
    ?>
    <div class="w-full h-full flex flex-col">
        <header class="w-full bg-white py-4 px-6 shadow-md mb-4">
            <h1 class="text-2xl font-semibold text-gray-700">List of Users</h1>
        </header>

        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table id="userTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gray-200 text-black uppercase text-sm leading-normal">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Name</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Email</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Gender</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Age</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">User Type</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Date of Birth</th>
                        </tr>
                    </thead>
                    <tbody class="text-black-700 text-sm font-light">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['correo']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['genero']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['edad']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['tipo_usuario']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['fecha_nac']); ?></td>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
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
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        width: 200px;
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
