<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .carousel {
            width: 100%;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 10px;
            max-height: 400px; 
        }

        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        main .card {
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        main .card h2 {
            color: #4F6652;
            margin-bottom: 20px;
        }

        main .card p {
            color: #6c757d;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        main .card .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        main .card .button-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        main .card button, main .card select {
            background-color: #4F6652;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        main .card button:hover, main .card select:hover {
            background-color: #B1BFB2;
        }

        main .card select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        main .card .select-container {
            position: relative;
            display: inline-block;
        }

        main .card .select-container::after {
            content: '▼';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: white;
        }

        .hidden {
            display: none;
        }

        .message {
            background-color: rgba(177, 191, 178, 0.9);
            color: #4F6652;
            padding: 40px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            font-size: 3rem; 
            text-align: center;
            width: 80%; 
            display: none;
        }
    </style>
</head>
<body>
    <div class="carousel">
        <img src="../../img/c1.jpg" alt="Slide 1">
        <img src="../img/c2.jpg" alt="Slide 2">
        <img src="../img/c3.jpg" alt="Slide 3">
    </div>

    <main>
        <section class="card">
            <h2>INFORMES</h2>
            <p>Transparencia y resultados: Explora nuestros informes para ver cómo tus contribuciones están cambiando vidas.</p>
            <div class="button-container">
                <button onclick="location.href='#'">Ver más</button>
            </div>
        </section>

        <section class="card">
            <h2>DONACIONES</h2>
            <p>Cada contribución cuenta. Dona ahora y sé parte del cambio que quieres ver en el mundo. Consulta el historial de tus donaciones para ver el impacto que has logrado.</p>
            <div class="button-container">
                <div class="button-row">
                    <button onclick="location.href='#'">Ver</button>
                    <div class="select-container">
                        <select id="donationSelect" onchange="handleDonateChange(this)">
                            <option value="" disabled selected>Donar</option>
                            <option value="voluntario">Tiempo como voluntario</option>
                            <option value="materiales">Materiales o suministros</option>
                            <option value="tecnologia">Equipos tecnológicos</option>
                            <option value="otro">Otro (especificar)</option>
                        </select>
                    </div>
                </div>
                <input type="text" id="otherInput" class="hidden" placeholder="Especifica aquí">
                <button id="donateButton" class="hidden" onclick="handleDonate()">Donar</button>
            </div>
        </section>

        <section class="card">
            <h2>CONTACTO</h2>
            <p>Queremos escucharte. Ponte en contacto con nosotros para colaborar o recibir más información sobre nuestras actividades.</p>
            <div class="button-container">
                <button onclick="location.href='#'">Contactar</button>
            </div>
        </section>
    </main>

    <div id="thankYouMessage" class="message">
        Gracias por creer en nuestra causa y por ser parte de esta comunidad que se esfuerza por un futuro mejor.
    </div>

    <script>
        // JavaScript para el carrusel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel img');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = (i === index) ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 3000); 

        
        showSlide(currentSlide);

        function handleDonateChange(select) {
            const value = select.value;
            const otherInput = document.getElementById('otherInput');
            const donateButton = document.getElementById('donateButton');

            if (value === 'otro') {
                otherInput.classList.remove('hidden');
            } else {
                otherInput.classList.add('hidden');
            }

            donateButton.classList.remove('hidden');
        }

        
        function handleDonate() {
            const select = document.getElementById('donationSelect');
            const otherInput = document.getElementById('otherInput');
            const thankYouMessage = document.getElementById('thankYouMessage');

            let donationValue = select.value;
            if (donationValue === 'otro') {
                donationValue = otherInput.value;
            }

            alert('Seleccionaste: ' + donationValue);
            thankYouMessage.style.display = 'block';

            
            setTimeout(() => {
                thankYouMessage.style.display = 'none';
            }, 5000);

            // Enviar datos al servidor
            const formData = new FormData();
            formData.append('donation', donationValue);

            fetch('send_email.php', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    console.log('Correo enviado con éxito');
                } else {
                    console.error('Error al enviar el correo');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

    <?php include '../../footer.php'; ?>
</body>
</html>
