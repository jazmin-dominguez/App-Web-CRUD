<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate Your Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="RegistroForm.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="header">
        <h1 class="title-project"><i class="fa-regular fa-face-smile"></i> ********** | Khan Academy <img src="khan.png" alt="Icono de ejemplo" class="custom-icon"></h1> 
    </div>

    <div class="nav">
        <button><span class="left-arrow">&lt;</span> Registro de actividades</button>
        <button><span class="left-arrow">&lt;</span> Actualización de estados de tarea</button>
        <button class="transparent-btn"><i class="fa-solid fa-envelope"></i> Coordinadores</button>
        <button class="transparent-btn"><i class="fa-solid fa-envelope"></i> Voluntarios</button>
    </div> 
    <div class="container">
        <h1>Registro de Actividad</h1>

            <form id="registro-actividad-form" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombreactividad" class="form-label">Nombre de la Actividad</label>
                    <input type="text" class="form-control" id="nombreactividad" name="nombreactividad" placeholder="Nombre de la actividad">
                </div>

                <div class="mb-3">
                    <label for="tipo_actividad" class="form-label">Tipo de Actividad</label>
                    <select id="tipo_actividad" name="tipo" class="form-control">
                        <option value="AudioVisual">AudioVisual</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="video" class="form-label">Inserta actividad Video</label>
                    <input type="file" class="form-control" accept="video/mp4" id="video" name="video">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Descripción breve"></textarea>
                </div>

                <div class="mb-3">
                    <label for="duracion" class="form-label">Duración</label>
                    <input type="date" class="form-control" id="duracion" name="duracion">
                </div>

                <button type="button" class="btn btn-primary" id="guardar-btn">Guardar</button>
            </form>
    </div>

    <script>
        document.getElementById('guardar-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

            // Recoger datos del formulario
            let formData = new FormData(document.getElementById('registro-actividad-form'));

            // Enviar datos vía fetch API
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
                        title: '¡Registro exitoso!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Mostrar alerta SweetAlert2 para error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Intentar de nuevo'
                    });
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Ocurrió un problema al enviar los datos.',
                    confirmButtonText: 'Intentar de nuevo'
                });
            });
        });
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3cbc38d055.js" crossorigin="anonymous"></script>
</body>
</html>
