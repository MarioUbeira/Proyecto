// Obtener referencias a los elementos DOM
const mainBtn = document.getElementById('mainBtn');
const submenu = document.getElementById('submenu');

// Agregar un evento de click al botón principal
mainBtn.addEventListener('click', () => {
    console.log('Se hizo clic en el botón principal');
    // Si el submenú está oculto, mostrarlo. Si no, ocultarlo.
    if (submenu.style.display === 'none') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
});
