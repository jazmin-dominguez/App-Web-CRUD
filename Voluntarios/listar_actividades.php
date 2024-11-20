<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_actividades();

$materias = $obj->listar_materias();
$teachers = $obj->obtener_usuarios_teachers();

if ($result === false) {
    echo '<p class="text-center text-red-500">Error en la consulta a la base de datos.</p>';
} elseif ($result->num_rows === 0) {
    echo '<p class="text-center text-red-500">No se encontraron actividades.</p>';
} else {
?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="w-full h-full flex flex-col">
        <header class="w-full bg-white py-4 px-6 shadow-md mb-4">
            <h1 class="text-2xl font-semibold text-gray-700">List of Activities</h1>
        </header>
        
        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table id="activityTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gray-200 text-black uppercase text-sm leading-normal">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Activity Name</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Description</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Subject</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Teacher</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Submissions</th>
                            <th class="px-4 py-2 border border-gray-300 text-center text-blue-800">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-black-700 text-sm font-light">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_actividad'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300 max-w-md"><?php echo htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_materia'] ?? 'No asignado', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo isset($row['nombre_teacher']) ? htmlspecialchars($row['nombre_teacher'], ENT_QUOTES, 'UTF-8') : 'No asignado'; ?></td>
                                <td class="px-4 py-2 border border-gray-300 text-center"><?php echo $row['entregas_realizadas'] ?? '0'; ?></td>
                                <td class="px-4 py-2 border-b border-gray-300 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Botón para editar -->
                                        <button class="edit-button bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600" 
                                            data-id="<?php echo $row['id']; ?>" 
                                            data-nombre="<?php echo htmlspecialchars($row['nombre_actividad'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-descripcion="<?php echo htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-materia="<?php echo $row['fk_materia'] ?? ''; ?>"
                                            data-teacher="<?php echo $row['fk_teacher'] ?? ''; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Botón para eliminar -->
                                        <button class="delete-button bg-red-500 text-white px-2 py-1 rounded" 
                                            data-id="<?php echo $row['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para editar -->
    <div id="editActivityModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
          <h2 class="text-xl font-semibold mb-4">Edit Activity</h2>
          <form id="editActivityForm" class="space-y-6">
            <input type="hidden" id="editActivityId" name="id">

            <div>
                <label for="editActivityName" class="block text-sm font-medium text-gray-700">Activity Name:</label>
                <input type="text" name="nombre_actividad" id="editActivityName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label for="editActivityDescription" class="block text-sm font-medium text-gray-700">Description:</label>
                <input type="text" name="descripcion" id="editActivityDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label for="editActivitySubject" class="block text-sm font-medium text-gray-700">Subject:</label>
                <select id="editActivitySubject" name="materia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <?php foreach ($materias as $materia): ?>
                        <option value="<?php echo $materia['id']; ?>"><?php echo $materia['nombre_materia']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="editActivityTeacher" class="block text-sm font-medium text-gray-700">Teacher:</label>
                <select id="editActivityTeacher" name="teacher" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <?php foreach($teachers as $teacher): ?>
                        <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="closeActivityModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
          </form>
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

            // Abrir modal de edición
            $(document).on('click', '.edit-button', function() {
                const id = $(this).data('id');
                const nombre = $(this).data('nombre');
                const descripcion = $(this).data('descripcion');
                const materia = $(this).data('materia');
                const teacher = $(this).data('teacher');

                $('#editActivityId').val(id);
                $('#editActivityName').val(nombre);
                $('#editActivityDescription').val(descripcion);
                $('#editActivitySubject').val(materia);
                $('#editActivityTeacher').val(teacher);

                $('#editActivityModal').removeClass('hidden');
            });

            // Cerrar modal
            function closeActivityModal() {
                $('#editActivityModal').addClass('hidden');
            }

            // Guardar cambios
            $('#editActivityForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();
                fetch("modificar_actividad.php", {
                    method: "POST",
                    body: data,
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }
                })
                .then(response => response.text())
                .then(response => {
                    if (response.trim() === "success") {
                        location.reload();
                    } else {
                        Swal.fire("Error", "There was a problem updating the activity.", "error");
                    }
                });
            });

            // Eliminar actividad
            $(document).on('click', '.delete-button', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("eliminar_actividad.php", {
                            method: "POST",
                            body: `id=${id}`,
                            headers: { "Content-Type": "application/x-www-form-urlencoded" }
                        })
                        .then(response => response.text())
                        .then(response => {
                            if (response.trim() === "success") {
                                location.reload();
                            } else {
                                Swal.fire("Error", "There was a problem deleting the activity.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>

<?php } ?>
