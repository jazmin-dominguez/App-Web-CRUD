    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== REMIXICONS ===============-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="swiper-bundle.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="misprofes.css">

        <title>Responsive card slider - Bedimcode</title>
    </head>
    <body>
        <header>
            <div class="header-content">
                <h1>Khan Academy</h1>
                <p>Hola Ariel Saúl</p>
            </div>
        </header>

        <section class="container">
            <div class="card__container swiper">
                <div class="card__content">
                <div class="swiper-wrapper">
                    <article class="card__article swiper-slide">
                        <div class="circle-container">
                            <img src="img/avatar-1.png" alt="image" class="card__img">
                            <div class="card__shadow"></div>
                        </div>
        
                        <div class="card__data">
                            <h3 class="card__name">Juan Pablo Vargas</h3>
                            <p class="card__description">Materia: <strong>Matematicas</strong></p>
                            <p class="card__description">Egresado de: <strong>Universidad de *****</strong></p>
                            <br> 
                            <a href="#" class="card__button">View More</a>
                        </div>
                    </article>
        
                    <article class="card__article swiper-slide">
                        <div class="circle-container">
                            <img src="img/avatar-3.png" alt="image" class="card__img">
                            <div class="card__shadow"></div>
                        </div>
        
                        <div class="card__data">
                            <h3 class="card__name">Jesus Emilio Ballinas</h3>
                            <p class="card__description">Materia: <strong>Computacion</strong></p>
                            <p class="card__description">Egresado de: <strong>Universidad de *****</strong></p>
                            <br> 
                            <a href="#" class="card__button">View More</a>
                        </div>
                    </article>
        
                    <article class="card__article swiper-slide">
                        <div class="circle-container">
                            <img src="img/avatar-1.png" alt="image" class="card__img">
                            <div class="card__shadow"></div>
                        </div>
        
                        <div class="card__data">
                            <h3 class="card__name">Magali Moreno</h3>
                            <p class="card__description">Materia: <strong>Ingles</strong></p>
                            <p class="card__description">Egresado de: <strong>Universidad de *****</strong></p>
                            <br> 
                            <a href="#" class="card__button">View More</a>
                        </div>
                    </article>
        
                    <article class="card__article swiper-slide">
                        <div class="circle-container">
                            <img src="img/avatar-3.png" alt="image" class="card__img">
                            <div class="card__shadow"></div>
                        </div>
        
                        <div class="card__data">
                            <h3 class="card__name">Enrique Carlos Busquets</h3>
                            <p class="card__description">Materia: <strong>Base de datos</strong></p>
                            <p class="card__description">Egresado de: <strong>Universidad de *****</strong></p>
                            <br> 
                            <a href="#" class="card__button">View More</a>
                        </div>
                    </article>

                    <article class="card__article swiper-slide">
                        <div class="circle-container">
                            <img src="img/avatar-3.png" alt="image" class="card__img">
                            <div class="card__shadow"></div>
                        </div>
        
                        <div class="card__data">
                            <h3 class="card__name">Tomas Dias Garcia</h3>
                            <p class="card__description">Materia: <strong>Derecho Informatico</strong></p>
                            <p class="card__description">Egresado de: <strong>Universidad de *****</strong></p>
                            <br> 
                            <a href="#" class="card__button">View More</a>
                        </div>
                    </article>
                </div>
                </div>

                <!-- Navigation buttons -->
                <div class="swiper-button-next">
                <i class="ri-arrow-right-s-line"></i>
                </div>
                
                <div class="swiper-button-prev">
                <i class="ri-arrow-left-s-line"></i>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
        
        <?php include 'footer.php' ;?>
        
        <!--=============== SWIPER JS ===============-->
        <script src="swiper-bundle.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="main.js"></script>

        
    </body>
    </html>