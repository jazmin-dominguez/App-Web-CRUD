<?php
require_once '../Conexion/contacto.php';
$obj = new Contacto();
$result = $obj->listar_usuarios();

if ($result && $result->num_rows > 0) {
?>

<link rel="stylesheet" href="../CSS/tabla.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"/>
<div class="w-full h-full flex flex-col">
    <header class="w-full bg-white py-4 px-6">
        <h1 class="text-2xl text-gray-700">List of Users</h1>
    </header>
    <div class="flex-grow bg-gray-100 p-6">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-300">Name</th>
                        <th class="px-4 py-2 border-b border-gray-300">Email</th>
                        <th class="px-4 py-2 border-b border-gray-300">Gender</th>
                        <th class="px-4 py-2 border-b border-gray-300">Age</th>
                        <th class="px-4 py-2 border-b border-gray-300">User Type</th>
                        <th class="px-4 py-2 border-b border-gray-300">Date of Birth</th>
                        <th class="px-4 py-2 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr id="row_<?php echo $row['id']; ?>">
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['genero']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['edad']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['tipo_usuario']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['fecha_nac']); ?></td>
                            <td class="px-4 py-2 border-b border-gray-300">
                                <button onclick="openModal(<?php echo $row['id']; ?>, '<?php echo $row['nombre']; ?>', '<?php echo $row['correo']; ?>', '<?php echo $row['genero']; ?>', '<?php echo $row['tipo_usuario']; ?>', '<?php echo $row['fecha_nac']; ?>')" class="bg-blue-500 text-white px-4 py-2 rounded"><i class="ri-edit-2-line"></i></button>
                                <button onclick="deleteUser(<?php echo $row['id']; ?>)" class="bg-red-500 text-white px-4 py-2 rounded"><i class="ri-delete-bin-fill"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<div id="editModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
      <h2 class="text-xl font-semibold mb-4">Edit User</h2>
      <form id="editUserForm" action="" method="post" class="space-y-6">
        <input type="hidden" id="editUserId" name="id">
        <input type="hidden" id="editUserAge" name="edad"> <!-- Campo oculto para la edad -->

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-user"></i> Name
                </label>
                <input type="text" name="nombre" id="editUserName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" name="correo" id="editUserEmail" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-venus-mars"></i> Gender
                </label>
                <div class="mt-2 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="genero" value="Masculino" id="editUserGenderM" class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Male</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="genero" value="Femenino" id="editUserGenderF" class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Female</span>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-user-tag"></i> User Type
            </label>
            <select name="tipo_usuario" id="editUserType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
                <option value="Donor">Donator</option>
                <option value="Coordinator">Coordinator</option>
                <option value="Administrator">Administrator</option>
            </select>
        </div>

        <div>
            <label for="fecha_nac" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-calendar-alt"></i> Date of Birth
            </label>
            <input type="date" name="fecha_nac" id="editUserDOB" max="2014-12-12" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" oninput="calculateAge()">
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function openModal(id, name, email, gender, userType, dob) {
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;

        if (gender === 'Masculino') {
            document.getElementById('editUserGenderM').checked = true;
        } else {
            document.getElementById('editUserGenderF').checked = true;
        }

        document.getElementById('editUserType').value = userType;
        document.getElementById('editUserDOB').value = dob;
        calculateAge();  // Calcula la edad cuando se abre el modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Función para calcular la edad a partir de la fecha de nacimiento
    function calculateAge() {
        var dob = document.getElementById('editUserDOB').value;
        if (dob) {
            var birthDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('editUserAge').value = age;  // Asignar la edad calculada
        }
    }

    // Manejo del formulario de edición para enviar datos al servidor
    document.getElementById('editUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de inmediato

        var formData = new FormData(this); // Recoge los datos del formulario

        // Llamada AJAX para enviar los datos al servidor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "guardar_usuario.php", true); // URL de tu script PHP para guardar los datos
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                closeModal();
                alert("User updated successfully");
            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                alert("Error updating user");
            }
        };
        xhr.send(formData);  // Enviar el formulario con los datos
    });
</script>

<?php
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id_eliminar'];
        if ($obj->eliminar_usuario($id)) {
            echo "<p class='text-blue-600 mt-4'>User successfully deleted</p>";
        } else {
            echo "<p class='text-red-600 mt-4'>Error deleting user.</p>";
        }
    }
}
?>
