<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_programas();

$materias = $obj->listar_materias(); // Función que lista todas las materias
$teachers = $obj->obtener_usuarios_teachers(); // Función que lista todos los maestros

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
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Name</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Description</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Subject</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">Name Teacher</th>
                            <th class="px-4 py-2 border border-gray-300 text-blue-800">User Type</th>
                            <th class="px-4 py-2 border border-gray-300 text-center text-blue-800">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-black-700 text-sm font-light">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['programa_nombre']); ?></td>
                                <td class="px-4 py-2 border border-gray-300 max-w-md"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre_materia']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo htmlspecialchars($row['tipo_usuario']); ?></td>
                                <td class="px-4 py-2 border-b border-gray-300 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="openProgramModal(<?php echo $row['id']; ?>, '<?php echo $row['programa_nombre']; ?>', '<?php echo $row['descripcion']; ?>', '<?php echo $row['nombre_materia']; ?>', '<?php echo $row['nombre']; ?>', '<?php echo $row['tipo_usuario']; ?>')" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"><i class="fas fa-edit"></i></button>
                                        <button onclick="deleteProgram(<?php echo $row['id']; ?>)" class="bg-red-500 text-white px-2 py-1 rounded"><i class="fas fa-trash"></i></button>
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

<!-- Modal para editar programa -->
<div id="editProgramModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
      <h2 class="text-xl font-semibold mb-4">Edit Program</h2>
      <form id="editProgramForm" class="space-y-6">
        <input type="hidden" id="editProgramId" name="id">

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="editProgramName" class="block text-sm font-medium text-gray-700">Program Name:</label>
                <input type="text" name="programa_nombre" id="editProgramName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label for="editProgramDescription" class="block text-sm font-medium text-gray-700">Description:</label>
                <input type="text" name="descripcion" id="editProgramDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
        </div>

        <div>
            <label for="editProgramSubject" class="block text-sm font-medium text-gray-700">Subject:</label>
            <select id="editProgramSubject" name="materia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <?php foreach ($materias as $materia): ?>
                    <option value="<?php echo $materia['id']; ?>"><?php echo $materia['nombre_materia']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="editProgramTeacher" class="block text-sm font-medium text-gray-700">Teacher:</label>
            <select id="editProgramTeacher" name="tipo_usuario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <button type="button" onclick="closeProgramModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openProgramModal(id, name, description, subject, teacher) {
        document.getElementById('editProgramId').value = id;
        document.getElementById('editProgramName').value = name;
        document.getElementById('editProgramDescription').value = description;

        const subjectSelect = document.getElementById('editProgramSubject');
        for (let i = 0; i < subjectSelect.options.length; i++) {
            if (subjectSelect.options[i].text === subject) {
                subjectSelect.selectedIndex = i;
                break;
            }
        }

        const teacherSelect = document.getElementById('editProgramTeacher');
        for (let i = 0; i < teacherSelect.options.length; i++) {
            if (teacherSelect.options[i].text === teacher) {
                teacherSelect.selectedIndex = i;
                break;
            }
        }

        document.getElementById('editProgramModal').classList.remove('hidden');
    }

    function closeProgramModal() {
        document.getElementById('editProgramModal').classList.add('hidden');
    }

    function deleteProgram(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminar_programa.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: "Your program has been deleted."
                        }).then(() => location.reload());
                    } else if (xhr.readyState === 4 && xhr.status !== 200) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "There was a problem deleting the program."
                        });
                    }
                };
                xhr.send("id=" + id);
            }
        });
    }

    document.getElementById('editProgramForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const id = document.getElementById('editProgramId').value;
        const name = document.getElementById('editProgramName').value;
        const description = document.getElementById('editProgramDescription').value;
        const subject = document.getElementById('editProgramSubject').value;
        const teacher = document.getElementById('editProgramTeacher').value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "modificar_programa.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                closeProgramModal();
                Swal.fire({
                    icon: "success",
                    title: "Program updated successfully",
                    text: "The program has been updated successfully."
                }).then(() => location.reload());
            } else if (xhr.readyState === 4) {
                Swal.fire({
                    icon: "error",
                    title: "Error updating program",
                    text: "There was an issue updating the program. Please try again."
                });
            }
        };
        xhr.send(`id=${id}&programa_nombre=${name}&descripcion=${description}&materia=${subject}&tipo_usuario=${teacher}`);
    });
</script>

<!-- DataTables Configuración -->
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
