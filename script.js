// Seleccionamos los elementos relevantes
const menuIcon = document.getElementById('menu-icon');
const mainMenu = document.getElementById('main-menu');
const beneficiariosBtn = document.getElementById('beneficiarios-btn');
const beneficiariosSubmenu = document.getElementById('beneficiarios-submenu');

// Función para alternar la visibilidad del menú principal
menuIcon.addEventListener('click', function() {
    if (mainMenu.style.display === 'block') {
        mainMenu.style.display = 'none';
    } else {
        mainMenu.style.display = 'block';
    }
});

// Función para alternar la visibilidad del submenú de Beneficiarios
beneficiariosBtn.addEventListener('click', function(event) {
    event.preventDefault(); // Prevenir que el enlace redirija
    if (beneficiariosSubmenu.style.display === 'block') {
        beneficiariosSubmenu.style.display = 'none';
    } else {
        beneficiariosSubmenu.style.display = 'block';
    }
});
