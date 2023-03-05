<!DOCTYPE html>
<html>
<script>
    setTimeout(function () {
        document.querySelector('.alerta').remove();
    }, 1000);
</script>
<?php
session_start();
// AÑADIR A FAVORITOS
if (isset($_SESSION['mensaje'])) {
    echo '<div class="alerta" id="alerta" style="text-align:center;">' . $_SESSION['mensaje'] . '</div>';
    unset($_SESSION['mensaje']);
}
// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    // Si el usuario no está logueado, establecer el rol en 3
    $_SESSION['rol'] = 3;
}
// Errores
ini_set('log_errors', 1);
ini_set('error_log', 'logs/error.log');

// Verificar si el usuario está logueado
if (isset($_POST['anadir'])) {
    $cod = $_POST['cod'];
    $unidades = (int) $_POST['unidades'];
    /* si existe el código sumamos las unidades */
    if (isset($_SESSION['carrito'][$cod])) {
        $_SESSION['carrito'][$cod] += $unidades;
    } else {
        $_SESSION['carrito'][$cod] = $unidades;
    }
    /* actualizamos el contador del carrito */
    $_SESSION['cart_count'] = count($_SESSION['carrito']);
}


?>
<!-- Head -->

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="css/general.css" rel="stylesheet" type="text/css">
    <link href="css/carrusel.css" rel="stylesheet" type="text/css">
    <link href="css/header.css" rel="stylesheet" type="text/css">

    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="imagenes/Logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
</head>
<!-- Body -->

<body>
    <!-- Header -->
    <header>
        <div class="containerH">

            <div class="infoPag">
                <a href="index.php">
                    <img src="imagenes/Header/Logo.svg" />
                    BricoTeis SL
                </a>
            </div>
            <!-- Buscador -->
            <div class="buscador">
                <form action="php/buscador.php" method="get">
                    <div class="cajaTexto">
                        <input type="text" name="query" name="query" placeholder="Buscar...">
                        <button type="submit">Buscar</button>
                    </div>
                </form>
            </div>
            <!-- Usuario, carrito, favoritos -->
            <div class="menuPers">
                <?php if (!isset($_SESSION['correo'])) {
                    echo '
                     <div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                         <div class="subdiv"><button><a href="View' . DIRECTORY_SEPARATOR . 'registro_view.php"><img src="imagenes/Header/01Menu/register.svg" /><div class="subText">REGISTRARSE</div></a></button>
                             </div>
                             <div class="subdiv"><button><a href="View' . DIRECTORY_SEPARATOR . 'login_view.php"><img src="imagenes/Header/01Menu/entrance.svg" /><div class="subText">INICIAR SESIÓN</div></a></button></div>
                         </div>
                     </div>
                     <div><a href="php' . DIRECTORY_SEPARATOR . 'favoritos.php"><img src="imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
    <div class="carrito"><a href ="php' . DIRECTORY_SEPARATOR . 'carrito.php"><img src="imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>';
                    require('php' . DIRECTORY_SEPARATOR . 'contador_carrito.php');
                    ;
                    '</div>';
                } else {
                    echo '<div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                    <div class="subdiv"><button><a href="Controller' . DIRECTORY_SEPARATOR . 'perfil_controlador.php"><img src="imagenes/Header/01Menu/edit.svg" /><div class="subText">EDITAR PERFIL</div></button></a>
                    </div>
                    <div class="subdiv"><button><a href="php' . DIRECTORY_SEPARATOR . 'logout.php"><img src="imagenes/Header/01Menu/exit.svg" /><div class="subText">CERRAR SESIÓN</div></a></button> ';
                    echo '</div>
                    </div>
                </div>
                <div><a href="php' . DIRECTORY_SEPARATOR . 'favoritos.php"><img src="imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
                <div class="carrito"><a href ="php' . DIRECTORY_SEPARATOR . 'carrito.php"><img src="imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>
                <div class="subcarrito">
                </div>';
                    require('php' . DIRECTORY_SEPARATOR . 'contador_carrito.php');
                    '</div>';
                } ?>
            </div>
    </header>
    <!-- Carrousel de banners -->
    <div class="carrusel">
        <div id="imagenCarr"></div>
    </div>
    <script src="javascript/carrusel.js"></script>
    <!-- Categorias -->
    <div class="separador">
        CATEGORÍAS
    </div>
    <div class="categorias">
        <div class="item"><a class="itA" href="php/productos.php?categoria=4"><img src="imagenes/Menu/Arena.svg" />Arenas y
            Gravas</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=1"><img src="imagenes/Menu/Techo.svg" />Tejados Y
            Cubiertas</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=2"><img src="imagenes/Menu/Cemento.svg" />Cementos Y
            Morteros</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=6"><img src="imagenes/Menu/Madera.svg" />Madera</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=7"><img
                    src="imagenes/Menu/Hormigonera.svg" />Hormigoneras, carretillas...</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=5"><img src="imagenes/Menu/Valla.svg" />Cercados y
            Ocultación</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=3"><img src="imagenes/Menu/Yeso.svg" />Yesos Y
            Escayolas</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=9"><img
                    src="imagenes/Menu/Eleconstruccion.svg" />Elementos de construcción</a></div>
        <div class="item"><a class="itA" href="php/productos.php?categoria=8"><img
                    src="imagenes/Menu/Aislante.svg" />Aislamientos</a></div>
    </div>
    <!-- Productos destacados -->
    <div class="separador">
        PRODUCTOS DESTACADOS
    </div>
    <?php
    require_once "Controller" . DIRECTORY_SEPARATOR . "productos_controlador.php";
    ?>
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/owl.carousel.min.js"></script>
    <script src="javascript/main.js"></script>
    <div class="separador">
        NUESTRA REVISTA
    </div>
    <div class="contenedorRevista">
        <img src="imagenes/Productos/47.png" />
        <div class="textoRev">
            <h2>La Revista Nº1 de construcción</h2>
            <p>Descubre las últimas tendencias y novedades en construcción con la revista líder en el mercado.
                Este
                semana no te pierdas el apartado especial "Architect", con consejos de un arquitecto profesional
                para
                construir tu casa de sueños. ¡Consigue tu ejemplar!</p>
            <form method='post'>
                <input type='hidden' name='cod' value='47'>
                <input type='hidden' name='unidades' value='1'>
                <button class='trollButton' name='anadir' type='submit'>AÑADIR AL CARRITO</button>
            </form>
        </div>
    </div>
    <!-- Compromisos -->
    <div class="separador">
        NUESTROS COMPROMISOS
    </div>
    <div class="compromisos">
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Calidad.svg" />
                CALIDAD ÓPTIMA
                <p>Nos aseguramos de que nuestros productos cumplan con los más altos estándares de
                    calidad para que puedas confiar en su rendimiento y durabilidad.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Cantidad.svg" />
                STOCK SIEMPRE DISPONIBLE
                <p>Nos esforzamos por mantener un amplio stock disponible para que siempre tengas lo que
                    necesitas para tus proyectos de construcción.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Velocidad.svg" />
                ENTREGAS RÁPIDAS
                <p>Brindamos un servicio de entrega rápido y eficiente para ser una parte integral en el éxito
                    de tus
                    proyectos de construcción.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Comunicacion.svg" />
                ATENCIÓN 24 HORAS
                <p>Estamos disponibles 24/7 para responder a tus preguntas y inquietudes sobre nuestros
                    productos de
                    construcción. ¡No dudes en contactarnos!</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Precio.svg" />
                PRECIOS IMBATIBLES
                <p>Ofrecemos precios competitivos para garantizar que tengas acceso a materiales de alta calidad
                    sin
                    sacrificar tu presupuesto.</p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <!-- Contactanos -->
        <script src="javascript/contactanos.js"></script>
        <!-- Redes -->
        <div class="redes">
            <div class="titulo">
                <h3>Nuestras Redes Sociales</h3>
            </div>
            <div class="contenido">
                <img src="imagenes/Footer/RRSS/facebook.svg" />
                <img src="imagenes/Footer/RRSS/twitter.svg" />
                <img src="imagenes/Footer/RRSS/youtube.svg" />
                <img src="imagenes/Footer/RRSS/instagram.svg" />
                <img src="imagenes/Footer/RRSS/linkedin.svg" />
                <img src="imagenes/Footer/RRSS/pinterest.svg" />
            </div>
        </div>
        <!-- Eco -->
        <div class="redes">
            <div class="titulo">
                <h3>Proyecto Ecológico</h3>
            </div>
            <div class="contenido">
                <a href="php/eco.php">
                    <img src="imagenes/Footer/ECO/Agua.svg" />
                    <img src="imagenes/Footer/ECO/Reciclaje.svg" />
                    <img src="imagenes/Footer/ECO/Renovable.svg" />
                </a>
            </div>
        </div>
        <!-- Pago -->
        <div class="redes">
            <div class="titulo">
                <h3>Pago 100% Seguro</h3>
            </div>
            <div class="contenido">
                <img src="imagenes/Footer/Pago/Amex.svg" />
                <img src="imagenes/Footer/Pago/Klarna.svg" />
                <img src="imagenes/Footer/Pago/Mastercard.svg" />
                <img src="imagenes/Footer/Pago/Paypal.svg" />
                <img src="imagenes/Footer/Pago/Visa.svg" />
            </div>
        </div>
        <!-- Redes -->
        <div class="redes">
            <div class="titulo">
                <h3>Información y Bases Legales</h3>
            </div>
            <!-- Info -->
            <div class="contenido">
                <a href="php/aboutUs.php">About Us</a>
                <a id="newsletter-link">Newsletter</a>

                <div id="newsletter-overlay">
                    <div id="newsletter-popup">
                        <button id="close-popup">X</button>
                        <h2>Suscríbete a nuestra Newsletter</h2>
                        <p>Ingresa tu correo electrónico para recibir nuestras últimas noticias y ofertas:</p>
                        <form>
                            <input type="email" name="email" placeholder="Tu correo electrónico" required>
                            <button type="submit">Suscribirse</button>
                        </form>
                    </div>
                </div>

                <script src="javascript/newsletter.js"></script>
                <a href="php/infoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>