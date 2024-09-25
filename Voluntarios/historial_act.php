<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Actividades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FFFDF7; 
        }

        h1 {
            margin-top: 20px;
            color: #738290;
        }

        .search-bar {
            margin: 20px 0;
            display: flex;
            align-items: center;
            width: 50%;
        }

        .search-bar input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #A1B5D8; 
            border-radius: 5px 0 0 5px;
            background-color: #E4F0D0; 
        }

        .search-bar button {
            padding: 10px;
            border: 1px solid #A1B5D8; 
            border-left: none;
            background-color: #738290; 
            color: white;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }

        .search-bar button:hover {
            background-color: #A1B5D8; 
        }

        .table-container {
            width: 80%;
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #C2D8B9; 
        }

        table th {
            background-color: #A1B5D8; 
            color: #FFFDF7; 
        }

        table tr:nth-child(even) {
            background-color: #E4F0D0; 
        }

        table tr:nth-child(odd) {
            background-color: #FFFDF7; 
        }
    </style>
</head>
<body>
    <h1>Historial de Actividades</h1>
    <div class="search-bar">
        <input type="text" placeholder="Buscar actividades...">
        <button>🔍</button>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Cantidad</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "UnityClass";

                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                
                $sql = "SELECT idactividades, nombre, estado, cantidad, fecha_registro FROM Actividades";
                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["idactividades"] . "</td>
                                <td>" . $row["nombre"] . "</td>
                                <td>" . $row["estado"] . "</td>
                                <td>" . $row["cantidad"] . "</td>
                                <td>" . $row["fecha_registro"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay actividades registradas</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
