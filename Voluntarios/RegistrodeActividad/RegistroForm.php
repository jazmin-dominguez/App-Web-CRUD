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

    <div class="container">
        <h1>Activity register</h1>

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
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3cbc38d055.js" crossorigin="anonymous"></script>
</body>
</html>
