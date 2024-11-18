<?php
// Incluir la conexión a la base de datos y la clase Contacto
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_materias(); // Cambiamos a listar_materias()

if ($result === false) {
    echo '<p class="text-center text-red-500">Error en la consulta a la base de datos.</p>';
} elseif ($result->num_rows === 0) {
    echo '<p class="text-center text-red-500">No se encontraron materias.</p>';
} else {
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<div class="w-full h-full flex flex-col">
    <br>
    <br>
    <h1 class="text-2xl font-bold text-gray-700">List of Subjects</h1>
    
    <div class="flex-grow bg-gray-100 p-6">
        <div class="overflow-x-auto">
            <table id="subjectTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg font-Jost">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Subject Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Objectives</th>
                        <th class="px-4 py-2 border border-gray-300 text-white bg-cyan-700">Activities</th>
                        <th class="px-4 py-2 border border-gray-300 text-center text-white bg-cyan-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_materia']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['objetivos']); ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?php // echo htmlspecialchars($row['']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openSubjectModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['nombre_materia'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['objetivos'], ENT_QUOTES); ?>')" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"><i class="fas fa-edit"></i></button>
                                    <button onclick="deleteSubject(<?php echo $row['id']; ?>)" class="bg-red-500 text-white px-2 py-1 rounded"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para editar materias -->
<div id="editSubjectModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <h2 class="text-xl font-semibold mb-4">Edit Subject</h2>
            <form id="editSubjectForm" class="space-y-6">
                <input type="hidden" id="editSubjectId" name="id">
                <div>
                    <label for="editSubjectName" class="block text-sm font-medium text-gray-700">Subject Name:</label>
                    <input type="text" name="nombre_materia" id="editSubjectName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label for="editSubjectObjectives" class="block text-sm font-medium text-gray-700">Objectives:</label>
                    <textarea name="objetivos" id="editSubjectObjectives" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="closeSubjectModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal con datos cargados
    function openSubjectModal(id, name, objectives) {
        document.getElementById('editSubjectId').value = id;
        document.getElementById('editSubjectName').value = name;
        document.getElementById('editSubjectObjectives').value = objectives;

        document.getElementById('editSubjectModal').classList.remove('hidden');
    }

    // Función para cerrar el modal
    function closeSubjectModal() {
        document.getElementById('editSubjectModal').classList.add('hidden');
    }

    // Función para eliminar una materia
    function deleteSubject(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This subject will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminar_materias.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            Swal.fire(
                                'Deleted!',
                                'Subject has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', 'Error deleting subject', 'error');
                        }
                    }
                };
                xhr.send("id=" + id);
            }
        });
    }

    // Función para enviar datos de actualización
    document.getElementById('editSubjectForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const id = document.getElementById('editSubjectId').value;
        const name = document.getElementById('editSubjectName').value;
        const objectives = document.getElementById('editSubjectObjectives').value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "modificar_materia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                closeSubjectModal();
                Swal.fire({
                    icon: "success",
                    title: "Subject updated successfully",
                    text: "The subject has been updated successfully."
                }).then(() => location.reload());
            } else if (xhr.readyState === 4) {
                Swal.fire({
                    icon: "error",
                    title: "Error updating subject",
                    text: "There was an issue updating the subject. Please try again."
                });
            }
        };
        xhr.send(`id=${id}&nombre_materia=${name}&objetivos=${objectives}`);
    });

    // Configuración de DataTables
    $(document).ready(function() {
        $('#subjectTable').DataTable({
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
