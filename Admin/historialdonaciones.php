<?php
include '../Conexion/contacto.php'; 

// Crear una instancia de la clase Contacto
$contacto = new Contacto();

// Obtener los programas usando el método de la clase Contacto
$result = $contacto->listar_historial_donaciones();
?>
<!-- Sección de Historial de Donaciones -->
<section id="historial_donaciones" class="relative flex flex-col items-center justify-center h-screen bg-white-100 text-gray-900">
    <h1 class="text-4xl font-bold mb-4 flex items-center text-cyan-800">
        <i class="ri-money-dollar-circle-fill mr-2 text-yellow-500"></i> <!-- Icono de dinero -->
        Donation History
    </h1>
    <p class="text-lg mb-4 text-cyan-700">Here you can see the history of all the donations made.</p>
    
    <!-- Consulta y visualización del historial de donaciones -->
    <div class="container mx-auto px-4">
        <?php
        $historial = $contacto->listar_historial_donaciones(); 
        if ($historial->num_rows > 0): ?>
            
            <!-- Agregar estilos y scripts necesarios -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

            <style>
                /* Estilos personalizados para la tabla */
                .table-container table {
                    border-collapse: collapse; /* Evitar espacios entre bordes */
                    width: 100%;
                }
                .table-container th,
                .table-container td {
                    border: 1px solid #ccc; /* Bordes para separar columnas */
                    padding: 8px 12px;
                    text-align: left;
                }
                .table-container th {
                    background-color: #007b83; /* Fondo para encabezado */
                    color: white;
                }
                .table-container tr:nth-child(even) {
                    background-color: #f9f9f9; /* Color alternativo para filas pares */
                }
                .table-container tr:hover {
                    background-color: #eef; /* Resaltar fila al pasar el cursor */
                }
            </style>

            <!-- Tabla con DataTables -->
            <div class="table-container">
                <table id="donationTable" class="table bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th>Donation date</th>
                            <th>Donor Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($donacion = $historial->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($donacion['fecha_donacion']); ?></td>
                                <td><?php echo htmlspecialchars($donacion['nombre_donacion']); ?></td>
                                <td><?php echo "$" . number_format($donacion['monto'], 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Configuración de DataTables -->
            <script>
                $(document).ready(function() {
                    $('#donationTable').DataTable({
                        "pageLength": 5,
                        "lengthMenu": [5, 10, 25, 50],
                        "dom": '<"flex justify-between items-center mb-4"l<"flex items-center"f>>rt<"flex justify-between items-center mt-4"ip>',
                        "language": {
                            "search": "",
                            "searchPlaceholder": "Search donations...",
                            "lengthMenu": "Show _MENU_ entries",
                            "info": "Showing _START_ to _END_ of _TOTAL_ donations",
                            "paginate": {
                                "first": "<<",
                                "last": ">>",
                                "next": ">",
                                "previous": "<"
                            }
                        },
                        "responsive": true
                    });
                });
            </script>
        <?php else: ?>
            <p class="text-center text-gray-700">No donations recorded.</p>
        <?php endif; ?>
    </div>
</section>
