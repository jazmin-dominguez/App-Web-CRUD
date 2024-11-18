<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon-->
    <!--<link rel="shourtcut icon" href=""-->

    <!--Remix icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"/>
    
    <!--Swiper's CSS-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <link href="./inicio/output.css" rel="stylesheet">
    <title>Landing Website</title>

    <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
<script>
    Weglot.initialize({
        api_key: 'wg_9ec94632da65fbf9be08565c3fe0a96b1',
        save_language: true // Añade esta línea
         // Establece el idioma basado en la sesión
    });
</script>
</head>

<body>
    <!--HEADER -->
    <header id="navbar" class="bg-cyan-700 fixed w-full top-0 left-0 z-50">
        <nav class="container flex items-center justify-between h-16 sm:h-20">   
        <div class="font-Lobster sm:text-2xl">Unity Class</div>
        <div id="google_translate_element" class="text-white text-sm bg-cyan-700 rounded px-2 py-1"></div>   
            <div id="nav-menu" class="absolute top-0 left-[-100%] min-h-[80vh] w-full
            bg-cyan-700/80 backdrop-blur-sm flex items-center 
            justify-center duration-300 overflow-hidden lg:static lg:min-h-fit
            lg:bg-transparent lg:w-auto">
                <ul class="flex flex-col items-center gap-8 lg:flex-row" >
                    <li>
                        <a href="#home" class="nav-link active">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="nav-link active">About</a>
                    </li>
                    <li>
                        <a href="login/login.php" class="nav-link">Login</a>
                    </li>
                    <li>
                        <a href="#Popular" class="nav-link">Popular</a>
                    </li>
                    <li>
                        <a href="#review" class="nav-link">Review</a>
                    </li>
                </ul>

                <div class="absolute bottom-0 -right-10 opacity-90 lg:hidden">
                    <img src="./SRC/3749827.png" alt="leaf_image" class="w-32">
                </div>

                <div class="absolute -top-5 -left-5 rotate-90 opacity-90 lg:hidden">
                    <img src="SRC/3819553.png" alt="leaf_image" class="w-32">
                </div>
            </div>

            <div class="text-xl sm:text-3xl cursor-pointer z-50 lg:hidden" >
                <i class="ri-menu-4-line" id="hamburger"></i>
            </div>
        </nav>
    </header>

    <main>

        <!-- HOME-->
        <section id="home" class="relative">
            <div class="container">
                <!--blob 1-->
            <div class="w-64 h-64 bg-cyan-300 rounded-full blur-3xl -z-10
            opacity-40 absolute top-1/2 left-1/2 transform -translate-x-1/2
            -translate-y-1/2"> 
            </div>
        
            <!--blob 2-->
            <div class="w-64 h-64 bg-cyan-300 rounded-full blur-3xl -z-10
            opacity-40 absolute right-0 bottom-0 "> 
            </div>

                <div class="flex flex-col items-center gap-5 lg:flex-row">
                    <!--CONTENT-->
                    <div class="home__data w-full space-y-5 lg:w-1/2">
                        <h1>
                            <span class="text-yellow-400">There is no limit</span>
                            <br>
                                To what you can 
                            <span class="text-yellow-400">Learn!</span>
                        </h1>

                        <p class="text-slate-300 font-Oswald">
                            Unity Class is dedicated to strengthening essential skills, 
                            helping students build a solid foundation for their academic 
                            and personal development. It also incorporates innovative tools 
                            to monitor and report progress towards the Sustainable Development 
                            Goals (SDGs), with a particular focus on promoting quality education 
                            (SDG 4) and reducing inequalities (SDG 10).
                        </p>

                        <div class="flex felx-col gap-2 sm:flex-row md:gap-4
                        lg:pt-5 xl:pt-10">
                        <a href="https://www.un.org/sustainabledevelopment/es/education/" target="_blank" class="btn">
                            <span>Start Now</span>
                            <i class="ri-open-arm-line"></i>
                        </a>

                        <a href="https://www.un.org/sustainabledevelopment/es/inequality/" target="_blank" class="btn btn_outline">
                            <span>Know More</span>
                            <i class="ri-open-arm-line"></i>
                        </a>
                        </a>
                        </div>

                        <p class="text-xs font-Lobster text-slate-300">
                            learn faster with us
                        </p>

                        <div>

                        </div>
                    </div>

                    <!--Image-->
                    <div class="w-full relative lg:w-1/2">
                        <img src="./SRC/Cartoon-math-learning-education-_processed.png" alt="home_image"
                        class="home__image w-81 h-auto">

                        <!--leaf-->
                        <div class="absolute -top-10 right-0 opacity-30 xl:top-5 
                        animate-movingY">
                            <i class="ri-open-arm-line text-6xl text-yellow-500"></i>
                        </div>

                        <!--flower-->
                        <div class="absolute bottom-0 left-0 opacity-30
                        xl:bottom-2 animate-rotating">
                            <i class="ri-pencil-ruler-line text-6xl text-yellow-500"></i>
                        </div>

                        <!--plant-->
                        <div class=" hidden absolute -top-8 -left-5 opacity-30
                        lg:block animate-scalingUp">
                            <i class="ri-school-line text-6xl text-yellow-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Servicios-->
        <div class="bg-white text-cyan-950 py-20">
            <div class="container w-full grid grid-cols-1 gap-8 md:grid-cols-2
            lg:grid-cols-3 xl:grid-cols-4">
                <!--Card 1-->
                <div class="service__card  border border-cyan-800 p-5 cursor-pointer
                rounded-md hover:shadow-2xl hover:-translate-y-1 duration-300 space-y-5"> 
                    <div class="flex items-center gap-5">
                        <i class="ri-folders-line text-3xl md:text-4xl xl:text-5xl"></i>
                        <p class="md:text-lg font-bold">
                            Programs <br>
                        </p>
                    </div>
                    <p class="font-Oswald">
                        The programs have the necessary subjects to achieve their objective.
                    </p>
                </div>

                <!--Card 2-->
                <div class=" service__card border border-cyan-800 p-5 cursor-pointer
                rounded-md hover:shadow-2xl hover:-translate-y-1 duration-300 space-y-5"> 
                    <div class="flex items-center gap-5">
                        <i class="ri-formula text-3xl md:text-4xl xl:text-5xl"></i>
                        <p class="md:text-lg font-bold">
                            Courses <br>
                        </p>
                    </div>
                    <p class="font-Oswald">
                        You will be able to enroll in courses that will help you improve and/or 
                        provide feedback on what you have learned in class.
                    </p>
                </div>

                <!--Card 3-->
                <div class="service__card  border border-cyan-800 p-5 cursor-pointer
                rounded-md hover:shadow-2xl hover:-translate-y-1 duration-300
                space-y-5"> 
                    <div class="flex items-center gap-5">
                        <i class="ri-file-text-line text-3xl md:text-4xl xl:text-5xl"></i>
                        <p class="md:text-lg font-bold">
                            Activities <br>
                        </p>
                    </div>
                    <p class="font-Oswald">
                        Activities or tasks are essential for improving quality education. 
                        When you enroll in a course you will get different activities.
                    </p>
                </div>

                <!--Card 4-->
                <div class="service__card  border border-cyan-800 p-5 cursor-pointer
                rounded-md hover:shadow-2xl hover:-translate-y-1 duration-300
                space-y-5"> 
                    <div class="flex items-center gap-5">
                        <i class="ri-star-line text-3xl md:text-4xl xl:text-5xl"></i>
                        <p class="md:text-lg font-bold">
                            Reviews<br>
                        </p>
                    </div>
                    <p class="font-Oswald">
                        The comments our users leave are important to help us improve as an 
                        educational organization. So you can leave a review of your most significant courses or subjects.
                    </p>
                </div>
            </div>
        </div>

        <!--About us -->
        <section id="about" class="relative overflow-hidden">
            <div class="about__leaf  absolute -top-8 -right-12 opacity-50">
                <img src="./SRC/1042474.png" alt="leaf_image"
                class="w-35 md:w-52 xl:w-64">
            </div>

            <div class="about__top  flex flex-col items-center gap-3 text-center mb-10
            md:mb-20">
                <h2 class="title">About</h2>
                <p class="max-w-2xl">Welcome to UNITY CLASS : Where Literacy Transforms Lives</p>
            </div>

            <div class="container space-y-10 xl:space-y-0">
                <!--Item 1-->
                <div class="flex flex-col items-center lg:flex-row gap-5">
                    <!--image-->
                    <div class="about__item__1-img  w-full lg:w-1/2">
                        <img src="./SRC/png-transparent-school-background.png" alt="about_image"
                        class="w-fullw sm:w-2/3 lg:w-full xl:w-2/3 mx-auto">
                    </div>

                    <!--content-->
                    <div class="about__item__1-content  w-full lg:w-1/2">
                        <div class="space-y-5">
                            <h3>Our <span class="text-yellow-500"></span> Mission
                            </h3>
                            <p class="text-slate-300 font-Oswald">The goal of our Unity Class is to teach and promote a 
                                strong culture around the importance of literacy, highlighting how essential it is for personal 
                                and collective development. We aim to raise awareness about how crucial it is to learn basic education
                                topics and some more of general interest, since these skills are essential to access educational and 
                                employment opportunities and to actively participate in society.
                            </p>
                        </div>
                    </div>
                </div>

                <!--Item 2-->
                <div class="flex flex-col items-center lg:flex-row-reverse 
                gap-5">
                    <!--image-->
                    <div class="about__item__2-img  w-full lg:w-1/2">
                        <img src="./SRC/png-transparent-studying-.png" alt="about_image"
                        class="w-fullw sm:w-2/3 lg:w-full xl:w-2/3 mx-auto">
                    </div>

                    <!--content-->
                    <div class="about__item__2-content  w-full lg:w-1/2">
                        <div class="space-y-5">
                            
                            <p class="text-slate-300 font-Oswald">The goal of Unity Class is not only focused on the school environment, 
                                but as creators of the project, we also seek to bring this message to our families and communities,
                                highlighting that literacy is an essential pillar for the progress and well-being of
                                all. Our project aims not only to expose the consequences of the lack of literacy,
                                but also to promote the learning necessary to overcome it.
                                We want to teach that literacy goes beyond the ability to read and write,
                                involving the understanding and effective use of information in daily life.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Popular-->
        <section id="Popular" class="bg-cyan-900">
            <div class="popular__top  flex flex-col items-center gap-3 text-center mb-40">
                <h2 class="title">Popular Programs</h2>
                <p class="max-w-2xl">find out about the most popular ones</p>
            </div>

            <div class="container w-full grid grid-cols-1 gap-x-8 gap-y-36
            md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <!--Cadr 1-->
                <div class="popular_card bg-cyan-950 p-10 pt-24 rounded-md relative">
                    <img src="./SRC/5078755.png" alt="popular_image"
                    class="w-52 absolute -top-5 left-1/2 transform
                    -translate-x-1/2 -translate-y-1/2  duration-500">

                    <h3 class="italic">Basic Literacy</h3>
                    <p>Jazmin Dguez</p>

                    <div class="text-yellow-500 text-xs py-3">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                        <i class="ri-star-line text-gray-400"></i>
                        <i class="ri-star-line text-gray-400"></i>
                    </div>
                </div>

                <!--Cadr 2-->
                <div class="popular_card bg-cyan-950 p-10 pt-24 rounded-md relative">
                    <img src="./SRC/símbolo-matemático.webp" alt="popular_image"
                    class="w-52 absolute -top-5 left-1/2 transform
                    -translate-x-1/2 -translate-y-1/2 duration-500">

                    <h3 class="italic">Basic Mathematics</h3>
                    <p>Luis Gonzalez</p>

                    <div class="text-yellow-500 text-xs py-3">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                        <i class="ri-star-line text-gray-400"></i>
                        <i class="ri-star-line text-gray-400"></i>
                    </div>
                </div>

                <!--Cadr 3-->
                <div class="popular_card bg-cyan-950 p-10 pt-24 rounded-md relative">
                    <img src="./SRC/desktop_77e774f8-a8db-4a84-a2f4-a09bd867809c.png" alt="popular_image"
                    class="w-52 absolute -top-5 left-1/2 transform
                    -translate-x-1/2 -translate-y-1/2 duration-500">

                    <h3 class="italic">Digital Skills Development</h3>
                    <p>Pablo Diaz</>

                    <div class="text-yellow-500 text-xs py-3">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                        <i class="ri-star-line text-gray-400"></i>
                        <i class="ri-star-line text-gray-400"></i>
                    </div>
                </div>

                <!--Cadr 4-->
                <div class="popular_card bg-cyan-950 p-10 pt-24 rounded-md relative">
                    <img src="./SRC/2654513.png" alt="popular_image"
                    class="w-40 absolute -top-5 left-1/2 transform
                    -translate-x-1/2 -translate-y-1/2  duration-500">

                    <h3 class="italic">Personal and Social Development</h3>
                    <p>Pati Rodriguez</p>

                    <div class="text-yellow-500 text-xs py-3">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                        <i class="ri-star-line text-gray-400"></i>
                        <i class="ri-star-line text-gray-400"></i>
                    </div>
                </div>
            </div>
        </section>

        <!--Review-->
        <section id="review" class="relative mb-20 md:mb-28 overflow-hidden">

            <!--<div class="review__leaf  absolute -top-8 -left-12 opacity-50">
                <img src="/SRC/532e26143a0435e9c6ca7f436474389f-icono-de-libros.webp" alt="leaf_image"
                class="w_40 md:w-52 xl:w-64">
            </div> -->

            <div class="review__top  flex flex-col items-center gap-3 text-center mb-10
            md:mb-20">
                <h2 class="title">User Reviews</h2>
                <p class="max-w-2xl">What our users say</p>
            </div>

            <div class="review__swiper  container">
                <div class="swiper py-12">
                    <ul class="swiper-wrapper">
                        <li class="swiper-slide" >
                            <div class="flex flex-col gap-5 bg-cyan-900
                            rounded-md p-6"> 
                                <p class="font-Oswald">
                                    "I've never been good at reading, but this course made 
                                    it easy for me. The interactive exercises are great."
                                </p>
                                <div class="flex items-center">
                                    <img src="./SRC/3849119.png" alt="review_image"
                                    class="w-12 h-12 rounded-full">
                                    <div class="ml-2">
                                        <p class="text-yellow-500 uppercase">Kevin Lopez</p>
                                        <p>Student</p>
                                    </div>
                                    <i class="ri-double-quotes-r text-4xl ml-auto"></i>
                                </div>
                            </div>
                        </li>

                        <li class="swiper-slide">
                            <div class="flex flex-col gap-5 bg-cyan-900
                            rounded-md p-6"> 
                                <p class="font-Oswald">
                                    "I've always had a hard time with math, 
                                    but I learned in a fun way here. The weekly 
                                    challenges helped me stay motivated, and I 
                                    now understand the problems in my classes better."
                                </p>
                                <div class="flex items-center">
                                    <img src="./SRC/4305686.png" alt="review_image"
                                    class="w-12 h-12 rounded-full">
                                    <div class="ml-2">
                                        <p class="text-yellow-500 uppercase">Sofia Bautista</p>
                                        <p>Student</p>
                                    </div>
                                    <i class="ri-double-quotes-r text-4xl ml-auto"></i>
                                </div>
                            </div>
                        </li>

                        <li class="swiper-slide">
                            <div class="flex flex-col gap-5 bg-cyan-900
                            rounded-md p-6"> 
                                <p class="font-Oswald">
                                    "I wasn't very good with computers, but this program helped 
                                    me learn the basics. I feel more prepared for the workforce now. 
                                    It just needs a little more depth on some advanced topics."
                                </p>
                                <div class="flex items-center">
                                    <img src="./SRC/3849119.png" alt="review_image"
                                    class="w-12 h-12 rounded-full">
                                    <div class="ml-2">
                                        <p class="text-yellow-500 uppercase">Luis Garcia</p>
                                        <p>Student</p>
                                    </div>
                                    <i class="ri-double-quotes-r text-4xl ml-auto"></i>
                                </div>
                            </div>
                        </li>

                        <li class="swiper-slide">
                            <div class="flex flex-col gap-5 bg-cyan-900
                            rounded-md p-6"> 
                                <p class="font-Oswald">
                                    "This course changed the way I talk to people. I learned to 
                                    communicate better, especially in discussions with friends and 
                                    family. I wish I had taken it sooner!"
                                </p>
                                <div class="flex items-center">
                                    <img src="./SRC/4305686.png" alt="review_image"
                                    class="w-12 h-12 rounded-full">
                                    <div class="ml-2">
                                        <p class="text-yellow-500 uppercase">Andrea Velazquez</p>
                                        <p>Student</p>
                                    </div>
                                    <i class="ri-double-quotes-r text-4xl ml-auto"></i>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </main>

    <!--Footer-->
    <footer class="bg-yellow-100 text-cyan-950 pt-20 pb-10 md:pt-28 relative">
        <!--Newsletter-->
        <!--<div class="container text-white absolute top-0 right-0 left-0 
            -translate-y-1/2">
            <div class="bg-cyan-900 px-10 pt-5 pb-10 space-y-5 rounded-md">
                <h3><span class="text-yellow-500">Subscribe</span>to our newsletter</h3>
            
                <div class="flex flex-col md:flex-row gap-1">
                    <input type="email" placeholder="Your Email Address"
                    class="w-full px-5 py-3 text-cyan-900 rounded-md
                    outline-none">
                    <button class="flex items-center justify-center gap-1 
                    bg-cyan-950 px-5 py-3 rounded-md hover:opacity-80 
                    duration-300">
                        <span>Subscribe</span>
                        <i class="ri-send-plane-2-fill"></i>
                    </button>
                </div>
        </div> -->

        <!--Content-->
        <div class="footer__content  container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3
        xl:grid-cols-4 gap-8 text-center md:text-start">
            <!--item 1-->
            <div >
                <div class="text-7xl text-cyan-700 text-center inline-block">
                    <i class="ri-leaf-fill"></i>
                    <p class="font-Lobster text-xl sm:text-2xl">UnityClass</p>
                </div>
            </div>

            <!--item 2-->
            <div>
                <p class="mb-5 font-bold text-xl">Quick Link</p>

                <div class="flex flex-col gap-1">
                    <a href="#home">Home</a>
                    <a href="#about">About </a>
                    <a href="login/login.php">Login</a>
                    <a href="#Popular">Popular</a>
                    <a href="#review">Review</a>
                </div>
            </div>

            <!--item 3-->
            <div>
                <p class="mb-5 font-bold text-xl">Popular services</p>

                <div class="flex flex-col gap-1">
                    <a href="#">Programs</a>
                    <a href="#">Courses</a>
                    <a href="#">Activities</a>
                    <a href="#">Reviews</a>
                </div>
            </div>

            <!--item 4-->
            <div>
                <p class="mb-5 font-bold text-xl">Contact Us</p>

                <div class="flex flex-col gap-1">
                    <a href="tel:+523131388210">+52 313 138 82 10</a>
                    <a href="mailto:classunity115@gmail.com">classunity115@gmail.com</a>
                    <br>
                    <p>Manzanillo,Colima Mexico </p>
                </div>
            </div>
        </div>

        <!--Copyright-->
        <div class="copy__right  container">
            <p class="text-center mt-10 opacity-50">Copyright &copy; 2024
                UnityClass. All richts reserved.
            </p>
        </div>

        <!--Floral image
        <div>
            <img src="" alt="">
        </div>-->
    </footer>

    <!--Scroll up-->
    <a href="#" class="fixed right-4 -bottom-1/2 bg-yellow-500 shadow-sm
    inline-block px-3 py-1 md:px-4 md:py-2 rounded-md text-lg z-50
    hover:-translate-y-1 duration-300" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>
    

    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!--SCROLLREVEAL-->
    <script src="./inicio/js/scrollreveal.min.js"></script>

    <!--mainjs-->
    <script src="./inicio/main.js"></script>
    
    
</body>
</html>