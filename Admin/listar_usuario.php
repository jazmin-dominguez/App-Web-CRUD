<?php
require_once '../Conexion/contacto.php';
                $obj = new Contacto();
                $result = $obj->listar_usuarios();

                if ($result && $result->num_rows > 0) {
                    ?>
                    <div class="w-full h-full flex flex-col">
                        <header class="w-full bg-white py-4 px-6">
                            <h1 class="text-2xl text-gray-700">Listado de Usuarios</h1>
                        </header>
                        <div class="flex-grow bg-gray-100 p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 border-b border-gray-300">Nombre</th>
                                            <th class="px-4 py-2 border-b border-gray-300">Correo</th>
                                            <th class="px-4 py-2 border-b border-gray-300">Género</th>
                                            <th class="px-4 py-2 border-b border-gray-300">Edad</th>
                                            <th class="px-4 py-2 border-b border-gray-300">Tipo de Usuario</th>
                                            <th class="px-4 py-2 border-b border-gray-300">Fecha de Nacimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['correo']); ?></td>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['genero']); ?></td>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['edad']); ?></td>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['tipo_usuario']); ?></td>
                                                <td class="px-4 py-2 border-b border-gray-300"><?php echo htmlspecialchars($row['fecha_nac']); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    // Mensaje de error si no hay resultados o hubo un problema con la consulta
                    echo '<p class="text-center text-red-500">No se encontraron usuarios o hubo un error en la consulta.</p>';
                }
                ?>