<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate Your Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXhW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="RegistroForm.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hidden {
            display: none;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="title-project"><i class="fa-regular fa-face-smile"></i> ********** | Khan Academy <img src="khan.png" alt="Icono de ejemplo" class="custom-icon"></h1> 
    </div>

    <div class="nav">
        <button id="registro-actividad-btn"><span class="left-arrow">&lt;</span> Registro de actividades</button>
        <button id="actualizacion-tareas-btn"><span class="left-arrow">&lt;</span> Actualización de estados de tarea</button>
        <button class="transparent-btn"><i class="fa-solid fa-envelope"></i> Coordinadores</button>
        <button class="transparent-btn"><i class="fa-solid fa-envelope"></i> Voluntarios</button>
        <button id="historial-btn" class="btn btn-primary"><i class="fa-solid fa-history"></i> Historial</button>
    </div>


    <div class="container">
        <h1>Activity register</h1>

        <div id="registro-actividad-section">
            <form id="registro-actividad-form" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombreactividad" class="form-label">Name activity</label>
                    <input type="text" class="form-control" id="nombreactividad" name="nombreactividad" placeholder="Name activity">
                </div>

                <div class="mb-3">
                    <label for="tipo_actividad" class="form-label">Activity type</label>
                    <select id="tipo_actividad" name="tipo" class="form-control">
                        <option value="AudioVisual">AudioVisual</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="video" class="form-label">Insert Video Activity</label>
                    <input type="file" class="form-control" accept="video/mp4" id="video" name="video">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Description</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Descripción breve"></textarea>
                </div>

                <div class="mb-3">
                    <label for="duracion" class="form-label">Duration</label>
                    <input type="date" class="form-control" id="duracion" name="duracion">
                </div>

                <button type="button" class="btn btn-primary" id="guardar-btn">Submitt</button>
            </form>
        </div>

        <!-- Historial -->
        <div id="historial-section" class="hidden">
            <h2>Historial de Actividades</h2>
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>State</th>
                            <th>Amount</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5">There are no registered activities</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('guardar-btn').addEventListener('click', function(event) {
            event.preventDefault(); 
            // Recoger datos del formulario
            let formData = new FormData(document.getElementById('registro-actividad-form'));

            
            fetch('Registro_Act.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Mostrar alerta SweetAlert2 para éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Successful registration!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Mostrar alerta SweetAlert2 para error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error in the submitt',
                    text: 'A problem occurred while sending the data.',
                    confirmButtonText: 'Try again.'
                });
            });
        });

        document.getElementById('historial-btn').addEventListener('click', function() {
            document.getElementById('registro-actividad-section').classList.add('hidden');
            document.getElementById('historial-section').classList.remove('hidden');
        });

        document.getElementById('registro-actividad-btn').addEventListener('click', function() {
            document.getElementById('registro-actividad-section').classList.remove('hidden');
            document.getElementById('historial-section').classList.add('hidden');
        });

        document.getElementById('actualizacion-tareas-btn').addEventListener('click', function() {
            document.getElementById('registro-actividad-section').classList.remove('hidden');
            document.getElementById('historial-section').classList.add('hidden');
        });
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3cbc38d055.js" crossorigin="anonymous"></script>
</body>
</html>
