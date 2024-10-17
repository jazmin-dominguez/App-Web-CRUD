<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la conexión a la base de datos
require_once '../Conexion/conexion.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Definir la consulta para obtener las materias
$query = "SELECT * FROM materias";
$conexion->sentencia = $query;

// Ejecutar la consulta usando el método de la clase
$result = $conexion->obtener_sentencia();

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table class='table-auto w-full'>";
        echo "<thead><tr><th>ID</th><th>Nombre de la Materia</th><th>Objetivos</th><th>Actividades</th><th>Unidad</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre_materia"] . "</td>";
            echo "<td>" . $row["objetivos"] . "</td>";
            echo "<td>" . $row["actividades"] . "</td>";
            echo "<td>" . $row["unidad"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No hay materias registradas.";
    }
} else {
    echo "Error en la consulta.";
}
?>
