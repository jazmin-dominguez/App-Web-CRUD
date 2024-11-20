<?php
  session_start();
  if (!isset($_SESSION['nombre'])) {
    header('Location: ../index.php');
  }

  // Verifica que el tipo de usuario esté en la sesión y asígnalo a la variable
$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'Desconocido';

  $showForm = isset($_GET['action']) && $_GET['action'] == 'dashboard';
  $showForm0 = isset($_GET['action']) && $_GET['action'] == 'crearusuario';
  $showForm1 = isset($_GET['action']) && $_GET['action'] == 'listarusuarios';
  $showForm2 = isset($_GET['action']) && $_GET['action'] == 'modificarusuario';
  $showForm3 = isset($_GET['action']) && $_GET['action'] == 'eliminarusuario';
  $showForm4 = isset($_GET['action']) && $_GET['action'] == 'crearmateria';
  $showForm5 = isset($_GET['action']) && $_GET['action'] == 'listarmateria';
  $showForm7 = isset($_GET['action']) && $_GET['action'] == 'eliminar_materias';
  $showForm8 = isset($_GET['action']) && $_GET['action'] == 'crearprograma';
  $showForm9 = isset($_GET['action']) && $_GET['action'] == 'listarprograma';
  $showForm10 = isset($_GET['action']) && $_GET['action'] == 'historialdonaciones';

?><?php include '../funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head><?php incluirWeglot(); ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Coordinador</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <style>
    .submenu {
      display: none;
    }
    .dropdown.open .submenu {
      display: block;
    }
  </style>
  <script>
    function toggleMenu(event) {
      const dropdown = event.currentTarget.parentNode;
      dropdown.classList.toggle('open');
    }
  </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen">
  <div class="flex h-full">
    <?php include('menu_lat.php'); ?>

    <main class="flex-grow ml-64">
      <!-- Encabezado con el Tipo de Usuario -->
      <header class="w-full bg-white py-4 px-6 flex justify-between items-center">
                <h1 class="text-2xl text-gray-700">Coordinator Panel</h1>
                <div class="text-gray-700">
                <a href="../login/logout.php" class="hover:underline">
                    <p class="font-semibold"><?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    
                </a>
                </div>
            </header>
        <?php

            if (!$showForm && !$showForm0 && !$showForm1 && !$showForm2 && !$showForm3 && !$showForm4 && !$showForm5 && !$showForm7 && !$showForm8 && !$showForm9 && !$showForm10):

                ?>
                <div class="w-full h-full flex flex-col">
                            <div class="flex-grow bg-gray-100 p-6">
                                <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                                <p class="text-gray-600 mt-2">Here is the data visualization.</p>

                                <div class="grid grid-cols-3 gap-4 mt-6">
                                    <!-- Tarjeta Usuarios -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of users</h3>
                                            <p id="totalUsuarios" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>

                                    <!-- Tarjeta Programas -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of programs</h3>
                                            <p id="totalProgramas" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>

                                    <!-- Tarjeta Materias -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of subjects</h3>
                                            <p id="totalMaterias" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                
                                <div class="grid grid-cols-3 gap-8 mt-8">
                                    <!-- Gráfico de usuarios -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">User Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('userChart', 'daily', '../Admin/obtener_datos_grafico.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('userChart', 'weekly', '../Admin/obtener_datos_grafico.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('userChart', 'monthly', '../Admin/obtener_datos_grafico.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="userChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('userChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('userChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('userChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>

                                    <!-- Gráfico de programas -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">Program Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('programChart', 'daily', '../Admin/obtener_graficos_programas.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('programChart', 'weekly', '../Admin/obtener_graficos_programas.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('programChart', 'monthly', '../Admin/obtener_graficos_programas.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="programChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('programChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('programChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('programChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>
                                    <!-- Gráfico de materias -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">Subject Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('subjectChart', 'daily', '../Admin/obtener_graficos_materias.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('subjectChart', 'weekly', '../Admin/obtener_graficos_materias.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('subjectChart', 'monthly', '../Admin/obtener_graficos_materias.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="subjectChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('subjectChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('subjectChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('subjectChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                const charts = {};

                                // Inicializar gráfico
                                function initializeChart(chartId) {
                                    const ctx = document.getElementById(chartId).getContext('2d');
                                    charts[chartId] = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: [],
                                            datasets: [{
                                                label: 'Registrations',
                                                data: [],
                                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        stepSize: 2,
                                                        precision: 0
                                                    }
                                                }
                                            }
                                        }
                                    });
                                }

                                // Actualizar datos del gráfico
                                function updateChartData(chartId, period, apiUrl) {
                                    fetch(`${apiUrl}?periodo=${period}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const labels = [];
                                            const chartData = [];

                                            data.forEach(item => {
                                                if (period === 'daily') {
                                                    labels.push(item.periodo);
                                                } else if (period === 'weekly') {
                                                    labels.push(`Week ${item.week} (${item.year})`);
                                                } else if (period === 'monthly') {
                                                    labels.push(`${item.month}/${item.year}`);
                                                }
                                                chartData.push(item.total);
                                            });

                                            charts[chartId].data.labels = labels;
                                            charts[chartId].data.datasets[0].data = chartData;
                                            charts[chartId].update();
                                        })
                                        .catch(error => console.error('Error fetching data:', error));
                                }

                                // Cambiar el tipo de gráfico
                                function updateChartType(chartId, type) {
                                    charts[chartId].config.type = type;
                                    charts[chartId].update();
                                }

                                // Inicializar gráficos al cargar la página
                                document.addEventListener('DOMContentLoaded', () => {
                                    initializeChart('userChart');
                                    initializeChart('programChart');
                                    initializeChart('subjectChart');

                                    // Cargar datos iniciales
                                    updateChartData('userChart', 'daily', '../Admin/obtener_datos_grafico.php');
                                    updateChartData('programChart', 'daily', '../Admin/obtener_graficos_programas.php');
                                    updateChartData('subjectChart', 'daily', '../Admin/obtener_graficos_materias.php');
                                });

                                // Cargar datos para las tarjetas
                                function cargarTotales() {
                                    fetch('../Admin/obtener_totales.php')
                                        .then(response => response.json())
                                        .then(data => {
                                            // Actualiza las tarjetas con los datos
                                            document.getElementById('totalUsuarios').textContent = data.usuarios;
                                            document.getElementById('totalProgramas').textContent = data.programas;
                                            document.getElementById('totalMaterias').textContent = data.materias;
                                        })
                                        .catch(error => console.error('Error al cargar los totales:', error));
                                }

                                // Llamar a la función al cargar la página
                                document.addEventListener('DOMContentLoaded', cargarTotales);

                            </script>
                        </div>
                    </div>
                <?php
            endif;
            if ($showForm):
                ?>
                <div class="w-full h-full flex flex-col">
                            <div class="flex-grow bg-gray-100 p-6">
                                <h2 class="text-4xl font-bold text-gray-800">Welcome <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
                                <p class="text-gray-600 mt-2">Here is the data visualization.</p>

                                <div class="grid grid-cols-3 gap-4 mt-6">
                                    <!-- Tarjeta Usuarios -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of users</h3>
                                            <p id="totalUsuarios" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>

                                    <!-- Tarjeta Programas -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of programs</h3>
                                            <p id="totalProgramas" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>

                                    <!-- Tarjeta Materias -->
                                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between">
                                        <div>
                                            <h3 class="text-gray-500 text-sm">Total number of subjects</h3>
                                            <p id="totalMaterias" class="text-2xl font-bold text-gray-800">0</p> <!-- Actualizado dinámicamente -->
                                        </div>
                                        <div class="text-pink-500 text-2xl">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                
                                <div class="grid grid-cols-3 gap-8 mt-8">
                                    <!-- Gráfico de usuarios -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">User Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('userChart', 'daily', '../Admin/obtener_datos_grafico.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('userChart', 'weekly', '../Admin/obtener_datos_grafico.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('userChart', 'monthly', '../Admin/obtener_datos_grafico.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="userChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('userChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('userChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('userChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>

                                    <!-- Gráfico de programas -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">Program Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('programChart', 'daily', '../Admin/obtener_graficos_programas.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('programChart', 'weekly', '../Admin/obtener_graficos_programas.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('programChart', 'monthly', '../Admin/obtener_graficos_programas.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="programChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('programChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('programChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('programChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>
                                    <!-- Gráfico de materias -->
                                    <div>
                                        <h3 class="text-center text-2xl font-semibold text-gray-700">Subject Registrations</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartData('subjectChart', 'daily', '../Admin/obtener_graficos_materias.php')" class="bg-blue-500 text-white px-2 py-1 rounded">Daily</button>
                                            <button onclick="updateChartData('subjectChart', 'weekly', '../Admin/obtener_graficos_materias.php')" class="bg-green-500 text-white px-2 py-1 rounded">Weekly</button>
                                            <button onclick="updateChartData('subjectChart', 'monthly', '../Admin/obtener_graficos_materias.php')" class="bg-red-500 text-white px-2 py-1 rounded">Monthly</button>
                                        </div>
                                        <canvas id="subjectChart" class="mt-4"></canvas>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="updateChartType('subjectChart', 'bar')" class="bg-blue-500 text-white px-2 py-1 rounded">Bar</button>
                                            <button onclick="updateChartType('subjectChart', 'line')" class="bg-green-500 text-white px-2 py-1 rounded">Line</button>
                                            <button onclick="updateChartType('subjectChart', 'pie')" class="bg-red-500 text-white px-2 py-1 rounded">Pie</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                const charts = {};

                                // Inicializar gráfico
                                function initializeChart(chartId) {
                                    const ctx = document.getElementById(chartId).getContext('2d');
                                    charts[chartId] = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: [],
                                            datasets: [{
                                                label: 'Registrations',
                                                data: [],
                                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        stepSize: 2,
                                                        precision: 0
                                                    }
                                                }
                                            }
                                        }
                                    });
                                }

                                // Actualizar datos del gráfico
                                function updateChartData(chartId, period, apiUrl) {
                                    fetch(`${apiUrl}?periodo=${period}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const labels = [];
                                            const chartData = [];

                                            data.forEach(item => {
                                                if (period === 'daily') {
                                                    labels.push(item.periodo);
                                                } else if (period === 'weekly') {
                                                    labels.push(`Week ${item.week} (${item.year})`);
                                                } else if (period === 'monthly') {
                                                    labels.push(`${item.month}/${item.year}`);
                                                }
                                                chartData.push(item.total);
                                            });

                                            charts[chartId].data.labels = labels;
                                            charts[chartId].data.datasets[0].data = chartData;
                                            charts[chartId].update();
                                        })
                                        .catch(error => console.error('Error fetching data:', error));
                                }

                                // Cambiar el tipo de gráfico
                                function updateChartType(chartId, type) {
                                    charts[chartId].config.type = type;
                                    charts[chartId].update();
                                }

                                // Inicializar gráficos al cargar la página
                                document.addEventListener('DOMContentLoaded', () => {
                                    initializeChart('userChart');
                                    initializeChart('programChart');
                                    initializeChart('subjectChart');

                                    // Cargar datos iniciales
                                    updateChartData('userChart', 'daily', '../Admin/obtener_datos_grafico.php');
                                    updateChartData('programChart', 'daily', '../Admin/obtener_graficos_programas.php');
                                    updateChartData('subjectChart', 'daily', '../Admin/obtener_graficos_materias.php');
                                });

                                // Cargar datos para las tarjetas
                                function cargarTotales() {
                                    fetch('../Admin/obtener_totales.php')
                                        .then(response => response.json())
                                        .then(data => {
                                            // Actualiza las tarjetas con los datos
                                            document.getElementById('totalUsuarios').textContent = data.usuarios;
                                            document.getElementById('totalProgramas').textContent = data.programas;
                                            document.getElementById('totalMaterias').textContent = data.materias;
                                        })
                                        .catch(error => console.error('Error al cargar los totales:', error));
                                }

                                // Llamar a la función al cargar la página
                                document.addEventListener('DOMContentLoaded', cargarTotales);

                            </script>
                        </div>
                    </div>
                <?php
            endif;
            if ($showForm0):
                include('crearusuario.php');
            endif;
            if ($showForm1):
                include('listar_usuario.php');
            endif;
            if ($showForm3):
                include('eliminar_usuario.php');
            endif;

            if ($showForm4):
              include('crearmateria.php');
            endif;
            if ($showForm5):
              include('listar_materias.php');
          endif;
      
            if($showForm8):
              include('crearprograma.php');
            endif;
            if($showForm9):
              include('listarprogramas.php');
            endif;
            if($showForm10):
                include('historialdonaciones.php');
              endif;
        ?>
    </main>
  </div>
</body>
</html>
