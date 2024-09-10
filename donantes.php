<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>donantes</title>
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
            justify-content: center;
        }

        main .card button {
            background-color: #4F6652;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        main .card button:hover {
            background-color: #B1BFB2;
        }
    </style>
</head>
<body>
    <div class="carousel">
        <img src="img/c1.jpg" alt="Slide 1">
        <img src="img/c2.jpg" alt="Slide 2">
        <img src="img/c3.jpg" alt="Slide 3">
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
                <button onclick="location.href='#'">Ver más</button>
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
    </script>
</body>
</html>
