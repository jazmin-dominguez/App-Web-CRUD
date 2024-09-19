<?php
include("connexion.php");

// Obtener el ID del voluntario de la URL
$matricula = isset($_GET['matricula']) ? intval($_GET['matricula']) : 0;

// Consultar la base de datos para obtener la información del voluntario
$sql = "SELECT nombres, apellidopaterno, apellidomaterno, nombrecurso, correo, foto FROM voluntarios WHERE matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $matricula);
$stmt->execute();
$result = $stmt->get_result();
$voluntario = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate Your Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calificar.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="header">
        <p class="title-project"><i class="fa-regular fa-face-smile"></i> ********** | Khan Academy <img src="khan.png" alt="Icono de ejemplo" class="custom-icon"></p> 
        <h1 class="beneficiario">hello Ariel Saul</h1>
        <div class="nav">
            <h2 class="rate">Rate</h2>
            <div class="article">
                <?php if ($voluntario): ?>
                      <div class="teacher-info">
                        <?php if (!empty($voluntario['foto'])): ?>
                            <img src="show_image.php?matricula=<?php echo urlencode($matricula); ?>" alt="Teacher Photo" class="teacher-photo">
                        <?php else: ?>
                            <p>No photo available</p>
                        <?php endif; ?>
                        <h3 class="teacher-project"><?php echo htmlspecialchars($voluntario['nombres'] . ' ' . $voluntario['apellidopaterno'] . ' ' . $voluntario['apellidomaterno']); ?></h3>
                      </div>
                    <p class="materia">Subject: <?php echo htmlspecialchars($voluntario['nombrecurso']); ?></p>
                    <p class="egreso">Discharge from: </p>
                    <p class="comentarios">Write your comments</p>
                    <p class="calificacion">Rate your teacher:</p>
                    <div class="rating-buttons">
                        <button class="rating-btn" id="btn-1" data-value="1">1</button>
                        <button class="rating-btn" id="btn-2" data-value="2">2</button>
                        <button class="rating-btn" id="btn-3" data-value="3">3</button>
                        <button class="rating-btn" id="btn-4" data-value="4">4</button>
                        <button class="rating-btn" id="btn-5" data-value="5">5</button>
                        <button class="rating-btn" id="btn-6" data-value="6">6</button>
                        <button class="rating-btn" id="btn-7" data-value="7">7</button>
                        <button class="rating-btn" id="btn-8" data-value="8">8</button>
                        <button class="rating-btn" id="btn-9" data-value="9">9</button>
                        <button class="rating-btn" id="btn-10" data-value="10">10</button>
                    </div>

                    <textarea id="comentario" name="comentario" rows="4" cols="50" placeholder="Escribe aquí tu comentario"></textarea><br><br>
                    <button id="rate-btn">Rate</button>
                <?php else: ?>
                    <p>Voluntario no encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3cbc38d055.js" crossorigin="anonymous"></script>
    <script>
      // Función para gestionar la selección de los botones
let selectedRating = null;

document.querySelectorAll('.rating-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Eliminar la clase 'active' de todos los botones
        document.querySelectorAll('.rating-btn').forEach(btn => btn.classList.remove('active'));
        
        // Añadir la clase 'active' al botón clickeado
        this.classList.add('active');
        
        // Guardar el valor seleccionado
        selectedRating = this.getAttribute('data-value');
    });
});

// Enviar la calificación y comentario
document.getElementById('rate-btn').addEventListener('click', function() {
    const comentario = document.getElementById('comentario').value;

    if (!selectedRating || !comentario) {
        alert("Please select a rating and enter a comment.");
        return;
    }

    // Crear un objeto con los datos
    const data = {
        comentario: comentario,
        calificacion: selectedRating
    };

    // Obtener el ID del voluntario de la URL
    const matricula = new URLSearchParams(window.location.search).get('matricula');

    // Enviar los datos mediante Fetch API a un script PHP
    fetch(`Rate_Teachers.php?matricula=${matricula}`, { // Incluye la matrícula en la URL
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert("Rating submitted successfully!");
        } else {
            alert("There was an error submitting the rating: " + result.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

    </script>
</body>
</html>
