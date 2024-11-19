<div class="w-64 bg-gray-800 fixed h-screen shadow md:h-full flex flex-col justify-between py-4 px-2">
    <div class="px-8">
        <a href="?action=dashboard">
            <h2 class="text-white text-2xl font-bold py-4">Dashboard</h2>
        </a>
        <ul class="mt-4">
            <!-- Actividades -->
            <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
                <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
                    Activities
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" class="arrow-down"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7" class="arrow-up hidden"></path>
                    </svg>
                </button>
                <ul class="submenu bg-gray-700 text-gray-200 pl-4">
                    <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=crearactividad">Create Activities</a></li>
                    <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listaractividades">List Activities</a></li>
                </ul>
            </li>
            <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
            <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
              Programs 
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
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listarprogramasinscritos">List Programs</a></li>
              
            </ul>
          </li>
          <!-- Usuarios -->
          <li class="dropdown text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
            <button onclick="toggleMenu(event)" class="flex justify-between items-center w-full focus:outline-none">
              Users
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
              <li class="py-2 hover:bg-gray-600 rounded-lg"><a href="?action=listarmateria">List Users </a></li>
              
            </ul>
          </li>
          <li class="text-gray-300 py-2 px-4 hover:bg-gray-700 rounded-lg">
                <button onclick="openContactModal()" class="flex items-center w-full focus:outline-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10l-6 6-6-6"></path>
                    </svg>
                    Contact
                </button>
            </li>
        </ul>
    </div>
    <div class="px-8 py-4">
        <a href="../login/logout.php">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                Log Out
            </button>
        </a>
    </div>
</div>
<div id="contactModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3 max-w-lg mx-auto">
        <h3 class="text-xl font-bold mb-4">Send Message</h3>
        <div>
            <label class="block text-gray-700">Select who contact</label>
            <select id="userRole" onchange="loadUsers()" class="w-full mt-2 p-2 border rounded-lg">
                <option value="">Choose...</option>
                <option value="coordinator">Coordinators</option>
                <option value="volunteer">Volunteers</option>
            </select>
        </div>
        <div id="userList" class="mt-4 hidden">
            <label class="block text-gray-700">Select User</label>
            <select id="selectedUser" class="w-full mt-2 p-2 border rounded-lg"></select>
        </div>
        <div id="userEmail" class="mt-4 hidden">
            <label class="block text-gray-700">Email</label>
            <input id="emailInput" class="w-full mt-2 p-2 border rounded-lg" type="email" readonly />
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="sendMessage()" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Send Email</button>
            <button onclick="closeContactModal()" class="ml-2 bg-gray-500 text-white font-bold py-2 px-4 rounded-lg">Cancel</button>
        </div>
    </div>
</div>


<script>
    // Functions to handle modal
    function openContactModal() {
        document.getElementById('contactModal').classList.remove('hidden');
    }
    
    function closeContactModal() {
        document.getElementById('contactModal').classList.add('hidden');
        document.getElementById('userRole').value = '';
        document.getElementById('userList').classList.add('hidden');
        document.getElementById('userEmail').classList.add('hidden');
    }

    function loadUsers() {
        const role = document.getElementById('userRole').value;
        const userList = document.getElementById('userList');
        const emailInput = document.getElementById('emailInput');
        
        if (role) {
            // Mock data for demonstration
            const users = role === 'coordinator' ? [
                { name: 'Alan', email: 'alan@ucol.mx' }
            ] : [
                { name: 'Laura', email: 'lau@gmail.com' },
                { name: 'Ernesto', email: 'ernesto@gmail.com' },
                { name: 'Joaquin', email: 'joa@gmail.com' }
            ];

            // Populate users dropdown
            const userSelect = document.getElementById('selectedUser');
            userSelect.innerHTML = '<option value="">Select a user</option>';
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.email;
                option.textContent = user.name;
                userSelect.appendChild(option);
            });

            userList.classList.remove('hidden');
            userSelect.onchange = () => {
                emailInput.value = userSelect.value;
                document.getElementById('userEmail').classList.remove('hidden');
            };
        } else {
            userList.classList.add('hidden');
            document.getElementById('userEmail').classList.add('hidden');
        }
    }

    function sendMessage() {
        const email = document.getElementById('emailInput').value;
        if (email) {
            window.location.href = `mailto:${email}`;
        }
    }
</script>
