// Seleccionar elementos del DOM
const newsletterLink = document.querySelector('#newsletter-link');
const newsletterOverlay = document.querySelector('#newsletter-overlay');
const closePopup = document.querySelector('#close-popup');

// Mostrar el pop-up cuando se hace clic en el enlace de newsletter
newsletterLink.addEventListener('click', function(event) {
  event.preventDefault(); // Evita la acción predeterminada del enlace
  
  // Mostrar el pop-up
  newsletterOverlay.style.display = 'block';
});

// Ocultar el pop-up cuando se hace clic en el botón de cierre
closePopup.addEventListener('click', function(event) {
  event.preventDefault(); // Evita la acción predeterminada del botón
  
  // Ocultar el pop-up
  newsletterOverlay.style.display = 'none';
});
