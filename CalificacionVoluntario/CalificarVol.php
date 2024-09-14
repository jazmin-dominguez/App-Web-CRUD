<?php
include("connexion.php");
$sql = "SELECT  matricula, nombres, apellidopaterno, apellidomaterno, nombrecurso, correo FROM voluntarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Khan Academy</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


    <div class="header">
        <h1>Evaluacion Docente</h1>
        <div class="url-bar">
            <img src="KHAN.png" alt="Khan Academy Logo">
        </div>
        <img src="U-removebg-preview.png" alt="Khan Academy Logo" class="logo-project">
        <div class="project-title">
            <p>Unity Class | Khan Academy</p>
        </div>
    </div>

    <div class="courses">
        <?php
        if ($result->num_rows > 0) {
            // Recorrer cada fila y mostrar los datos dinámicamente
            while($row = $result->fetch_assoc()) {
                echo "<div class='course-card'>";
                echo "<div class='course-icon'>📝</div>"; // Puedes cambiar el ícono dinámicamente si es necesario
                echo "<div class='course-info'>";
                echo "<h2>" . $row["nombrecurso"] . "</h2>";
                echo "<p>Teacher: " . $row["nombres"] . " " . $row["apellidopaterno"] . " " . $row["apellidomaterno"] . "</p>";
                echo "<p>Rate Your Teacher</p>";
                echo "<a href='calificar.php?matricula=" . $row["matricula"] . "'><button>Rate</button></a>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No hay registros disponibles.</p>";
        }
        ?>
    </div>

    <footer>
        <p>©Copyright 2024 Khan Academy</p>
    </footer>
</body>
</html>
