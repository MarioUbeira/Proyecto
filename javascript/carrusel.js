window.addEventListener('load', function() {
  const ANCHO_LIMITE = 768; // Define el ancho límite en el que se cambian las imágenes
  const IMAGENES = [
    'imagenes/Banner/Banner01.png',
    'imagenes/Banner/Banner02.png',
    'imagenes/Banner/Banner03.png'
  ];
  const IMAGENES2 = [
    'imagenes/Banner/BannerM01.png',
    'imagenes/Banner/BannerM02.png',
    'imagenes/Banner/BannerM03.png'
  ];
  const TIEMPO_INTERVALO_MILESIMAS_SEG = 2000;
  let posicionActual = 0;
  let $imagen = document.querySelector('#imagenCarr');
  let intervalo;
  window.addEventListener("resize", () => {
    pasarFoto();
  });

  function pasarFoto() {
    if (posicionActual >= IMAGENES.length - 1) {
      posicionActual = 0;
    } else {
      posicionActual++;
    }
    renderizarImagen();
  }

  function renderizarImagen() {
    // Decide qué conjunto de imágenes mostrar dependiendo del ancho de la ventana
    if (window.innerWidth <= ANCHO_LIMITE) {
      $imagen.style.backgroundImage = `url(${IMAGENES2[posicionActual]})`;
    } else {
      $imagen.style.backgroundImage = `url(${IMAGENES[posicionActual]})`;
    }
  }

  renderizarImagen();
  intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
});
