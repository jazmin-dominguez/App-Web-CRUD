<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Programs - Unity Class</title>
    <style>
        /* Color palette */
        body {
            background-color: #FFFCF7;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header */
        header {
            background: linear-gradient(45deg, #A1B5D8, #6D89A6);
            padding: 15px 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 90px;
            margin-right: 10px;
        }

        .logo h1 {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            color: #fff;
            margin: 0;
        }

        /* Main container */
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Style for program cards */
        .program-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .program-card:hover {
            transform: scale(1.05);
        }

        .program-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .program-card .description {
            padding: 15px;
            text-align: center;
        }

        .program-card .description h3 {
            margin: 10px 0;
            color: #A1B5D8;
        }

        .program-card .description p {
            font-size: 14px;
            color: #666;
        }

        /* Footer style */
        /*footer {
            background-color: #A1B5D8;
            padding: 10px;
            text-align: center;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }*/
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <!-- Logo and title -->
        <div class="logo">
            <img src="../../img/WhatsApp Image 2024-09-04 at 9,55,54 PM_processed.jpeg" alt="Unity Class Logo">
            <h1>Unity Class</h1>
        </div>
    </header>

    <!-- Main container with programs -->
    <div class="container">
        <!-- Program 1 -->
        <div class="program-card">
            <img src="img/Matematicas.png" alt="Interactive Mathematics">
            <div class="description">
                <h3>Interactive Mathematics</h3>
                <p>A program to learn mathematics interactively with practical exercises.</p>
            </div>
        </div>

        <!-- Program 2 -->
        <div class="program-card">
            <img src="img/Ciencias.png" alt="Science for Everyone">
            <div class="description">
                <h3>Science for Everyone</h3>
                <p>Explore the world of science with dynamic lessons and guided experiments.</p>
            </div>
        </div>

        <!-- Program 3 -->
        <div class="program-card">
            <img src="img/historia.png" alt="World History">
            <div class="description">
                <h3>World History</h3>
                <p>Learn about the most important events in history through videos and interactive resources.</p>
            </div>
        </div>

        <!-- Program 4 -->
        <div class="program-card">
            <img src="img/programacion.jpg" alt="Basic Programming">
            <div class="description">
                <h3>Basic Programming</h3>
                <p>Learn to program from scratch with easy tutorials and fun projects.</p>
            </div>
        </div>

        <!-- Program 5 -->
        <div class="program-card">
            <img src="img/artes.png" alt="Art and Creativity">
            <div class="description">
                <h3>Art and Creativity</h3>
                <p>Develop your creative skills with lessons on drawing, painting, and design.</p>
            </div>
        </div>

        <!-- Program 6 -->
        <div class="program-card">
            <img src="img/Estudiando.png" alt="University Preparation">
            <div class="description">
                <h3>University Preparation</h3>
                <p>Resources to help you prepare for exams and university life.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!--  <footer>
        <p>&copy; 2024 Unity Class. All rights reserved.</p>
    </footer> -->
    <?php include '../../footer.php';?>

</body>
</html>
