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
        <header class="w-full bg-white py-4 px-6 shadow-md mb-4">
            <h1 class="text-2xl text-gray-700">List of Subjects</h1>
        </header>
        <div class="flex-grow bg-gray-100 p-6">
            <div class="overflow-x-auto">
                <table id="programTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg font-Jost">
                    <thead class="bg-gray-200 ">
                        <tr>
                            
                            <th class="px-4 py-2 border border-gray-300  text-white bg-cyan-700">Subject Name</th>
                            <th class="px-4 py-2 border border-gray-300  text-white bg-cyan-700">Objectives</th>
                            <th class="px-4 py-2 border border-gray-300  text-white bg-cyan-700">Activities</th>
                            <th class="px-4 py-2 border border-gray-300  text-white bg-cyan-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="border hover:bg-gray-50">
                                
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row["nombre_materia"] ?? ''); ?></td>
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row["objetivos"] ?? ''); ?></td>
                                <td class="px-4 py-2 border  border-gray-300"><?php echo htmlspecialchars($row["actividades"] ?? ''); ?></td>
                                
                                <td class="px-4 py-2 border-b border-gray-300 text-center">
                                    <div class="flex justify-center space-x-2">
                                    <button onclick="openSubjectModal(<?php echo $row['id']; ?>, '<?php echo $row['nombre_materia']; ?>', '<?php echo $row['objetivos']; ?>', '<?php echo $row['actividades']; ?>')"  class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
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


<!-- Modal para editar materias -->
<div id="editSubjectModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
      <h2 class="text-xl font-semibold mb-4">Edit Subjects</h2>
      <form id="editSubjectForm" class="space-y-6">
        <input type="hidden" id="editsubjectId" name="id">

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="editProgramName" class="block text-sm font-medium text-gray-700">Subject Name:</label>
                <input type="text" name="programa_nombre" id="editProgramName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label for="editProgramDescription" class="block text-sm font-medium text-gray-700">Goals:</label>
                <input type="text" name="descripcion" id="editProgramDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
        </div>

        <div>
            <label for="editProgramSubject" class="block text-sm font-medium text-gray-700">Activity:</label>
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

<script>
    function openProgramModal(id, name, description, subject, teacher) {
        document.getElementById('editProgramId').value = id;
        document.getElementById('editProgramName').value = name;
        document.getElementById('editProgramDescription').value = description;

        // Seleccionar la opción correcta en el select de 'Subject'
        const subjectSelect = document.getElementById('editProgramSubject');
        for (let i = 0; i < subjectSelect.options.length; i++) {
            if (subjectSelect.options[i].text === subject) {
                subjectSelect.selectedIndex = i;
                break;
            }
        }

        // Seleccionar la opción correcta en el select de 'Teacher'
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
    if (confirm("Are you sure you want to delete this program?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "eliminar_programa.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Program deleted successfully");
                location.reload(); // Recarga la página después de la confirmación de eliminación
            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                alert("Error deleting program");
            }
        };
        xhr.send("id=" + id);
    }
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
                alert("Program updated successfully");
                location.reload();
            } else if (xhr.readyState === 4) {
                alert("Error updating program");
            }
        };
        xhr.send(`id=${id}&programa_nombre=${name}&descripcion=${description}&materia=${subject}&tipo_usuario=${teacher}`);
    });
</script>

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

