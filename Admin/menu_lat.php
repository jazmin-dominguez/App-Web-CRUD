<!-- Sidebar -->
<div class="w-64 bg-gray-800 fixed h-screen shadow md:h-full flex flex-col justify-between py-4 px-2">
      <div class="px-8">
        <a href="?action=dashboard">
            <h2 class="text-white text-2xl font-bold py-4">Dashboard</h2>
        </a>
        <ul class="mt-4">
          <!-- Usuarios -->
          <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
            <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
              Usuarios
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" 
                  class="arrow-down" 
                  :class="{ 'hidden': open, 'block': !open }"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7" 
                  class="arrow-up hidden" 
                  :class="{ 'block': open, 'hidden': !open }"></path>
              </svg>
            </button>
            <ul class="submenu bg-gray-700 text-gray-200 pl-4">
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=crearusuario">Crear Usuario</a></li>
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listarusuarios">Listar Usuarios</a></li>
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=modificarusuario">Modificar Usuarios</a></li>
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=eliminarusuario">Eliminar Usuarios</a></li>
              
            </ul>
          </li>
          <!-- Materias -->
          <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
            <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
              Materias
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" 
                  class="arrow-down" 
                  :class="{ 'hidden': open, 'block': !open }"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7" 
                  class="arrow-up hidden" 
                  :class="{ 'block': open, 'hidden': !open }"></path>
              </svg>
            </button>
            <ul class="submenu bg-gray-700 text-gray-200 pl-4">
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=crearmateria">Crear Materia</a></li>
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listarmateria">Listar Materias</a></li>
            </ul>
          </li>
          <!-- Actividades -->
          <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
            <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
              Actividades
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" 
                  class="arrow-down" 
                  :class="{ 'hidden': open, 'block': !open }"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7" 
                  class="arrow-up hidden" 
                  :class="{ 'block': open, 'hidden': !open }"></path>
              </svg>
            </button>
            <ul class="submenu bg-gray-700 text-gray-200 pl-4">
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=crearactividad">Crear Actividad</a></li>
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listaractividad">Listar Actividades</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="px-8 py-4">
        <a href="../login/logout.php">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
            Cerrar Sesión
            </button>
        </a>
        
      </div>
    </div>