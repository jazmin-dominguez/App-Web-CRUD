<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "unityclass";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de donaciones
$sql = "SELECT producto, cantidad, fecha FROM donaciones";
$result = $conn->query($sql);

$donations = [];

if ($result === FALSE) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donations[] = $row;
    }
} else {
    echo "No se encontraron donaciones.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Donaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4F6652;
            color: white;
            cursor: pointer;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        th.sort-asc::after {
            content: " ▲";
        }

        th.sort-desc::after {
            content: " ▼";
        }
    </style>
</head>
<body>
    <!-- Tabla de donaciones -->
    <div class="table-container">
        <table id="donationsTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Producto</th>
                    <th onclick="sortTable(1)">Cantidad</th>
                    <th onclick="sortTable(2)">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los datos -->
            </tbody>
        </table>
    </div>

    <script>
        // Función para ordenar la tabla
        function sortTable(n) {
            const table = document.getElementById("donationsTable");
            const rows = Array.from(table.rows).slice(1);
            const isAscending = table.rows[0].cells[n].classList.toggle("sort-asc");
            table.rows[0].cells[n].classList.toggle("sort-desc", !isAscending);
            
            rows.sort((rowA, rowB) => {
                const cellA = rowA.cells[n].innerText;
                const cellB = rowB.cells[n].innerText;

                if (isAscending) {
                    return cellA.localeCompare(cellB);
                } else {
                    return cellB.localeCompare(cellA);
                }
            });

            rows.forEach(row => table.tBodies[0].appendChild(row));
        }

        // Cargar datos en la tabla
        document.addEventListener('DOMContentLoaded', function() {
            const donations = <?php echo json_encode($donations); ?>;
            const tableBody = document.getElementById('donationsTable').querySelector('tbody');
            donations.forEach(donation => {
                const row = document.createElement('tr');
                Object.values(donation).forEach(text => {
                    const cell = document.createElement('td');
                    cell.textContent = text;
                    row.appendChild(cell);
                });
                tableBody.appendChild(row);
            });
        });
    </script>
</body>
</html>
