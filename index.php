<?php
use Models\Correo_modelo;
include("View/sesion.php");
?>
<!DOCTYPE html>
<html>
<!-- Head -->

<head>
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
                <form action="View/buscador.php" method="get">
                    <div class="cajaTexto">
                        <input type="text" name="query" name="query" placeholder="Buscar...">
                        <button type="submit">
                            <div class="lupa"><img src="imagenes/Header/lupa.svg" /></div>
                        </button>
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
                     <div><a href="View' . DIRECTORY_SEPARATOR . 'favoritos.php"><img src="imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
    <div class="carrito"><a href ="View' . DIRECTORY_SEPARATOR . 'carrito.php"><img src="imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>';
                    require('View' . DIRECTORY_SEPARATOR . 'contador_carrito.php');
                    ;
                    '</div>';
                } else {
                    echo '<div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                    <div class="subdiv"><button><a href="Controller' . DIRECTORY_SEPARATOR . 'perfil_controlador.php"><img src="imagenes/Header/01Menu/edit.svg" /><div class="subText">EDITAR PERFIL</div></button></a>
                    </div>
                    <div class="subdiv"><button><a href="View' . DIRECTORY_SEPARATOR . 'logout.php"><img src="imagenes/Header/01Menu/exit.svg" /><div class="subText">CERRAR SESIÓN</div></a></button> ';
                    echo '</div>
                    </div>
                </div>
                <div><a href="View' . DIRECTORY_SEPARATOR . 'favoritos.php"><img src="imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
                <div class="carrito"><a href ="View' . DIRECTORY_SEPARATOR . 'carrito.php"><img src="imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>
                <div class="subcarrito">
                </div>';
                    require('View' . DIRECTORY_SEPARATOR . 'contador_carrito.php');
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
        <div class="item"><a href="View/productos.php?categoria=4"><img src="imagenes/Menu/Arena.svg" /></a>Arenas y
            Gravas</div>
        <div class="item"><a href="View/productos.php?categoria=1"><img src="imagenes/Menu/Techo.svg" /></a>Tejados Y
            Cubiertas</div>
        <div class="item"><a href="View/productos.php?categoria=2"><img src="imagenes/Menu/Cemento.svg" /></a>Cementos Y
            Morteros</div>
        <div class="item"><a href="View/productos.php?categoria=6"><img src="imagenes/Menu/Madera.svg" /></a>Madera</div>
        <div class="item"><a href="View/productos.php?categoria=7"><img
                    src="imagenes/Menu/Hormigonera.svg" /></a>Hormigoneras, carretillas...</div>
        <div class="item"><a href="View/productos.php?categoria=5"><img src="imagenes/Menu/Valla.svg" /></a>Cercados y
            Ocultación</div>
        <div class="item"><a href="View/productos.php?categoria=3"><img src="imagenes/Menu/Yeso.svg" /></a>Yesos Y
            Escayolas</div>
        <div class="item"><a href="View/productos.php?categoria=9"><img
                    src="imagenes/Menu/Eleconstruccion.svg" /></a>Elementos de construcción</div>
        <div class="item"><a href="View/productos.php?categoria=8"><img
                    src="imagenes/Menu/Aislante.svg" /></a>Aislamientos</div>
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
    <script src="javascript/cantidadProd.js"></script>
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

    <?php
    if ($_SESSION['rol'] == 2) {
        echo '<button id="mainBtn">Admin.</button>
        <div id="submenu">
            <a href="View/admin/usuarios/editar_usuarios.html"><button>Administrar Usuarios</button></a>
            <a href="View/admin/productos/editar_productos.html"><button>Administrar Productos</button></a>
            <a href="View/admin/pedidos/visualizar_pedidos.php"><button>Administrar Pedidos</button></a>
        </div>';
        echo '<script src="javascript/admin.js"></script>';
    }
    ?>


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
                <a href="View/eco.php">
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
                <h3>Manténte al día</h3>
            </div>
            <!-- Info -->
            <div class="contenido">
                <a href="View/aboutUs.php">About Us</a>
                <a id="newsletter-link">Newsletter</a>
                <div id="newsletter-overlay">
                    <div id="newsletter-popup">
                        <button id="close-popup">X</button>
                        <h2>Suscríbete a nuestra Newsletter</h2>
                        <p>Ingresa tu correo electrónico para recibir nuestras últimas noticias y ofertas:</p>
                        <form method="post">
                            <input type="email" name="email" placeholder="Tu correo electrónico" required>
                            <button type="submit" name="sub">Suscribirse</button>
                            <?php if (isset($_POST['sub'])) {
                                Correo_modelo::enviar_correo($_POST['email'], $_SESSION['usuario'], "Gracias por subscribirte a nuestra newsletter " . $_POST['email']);
                            } ?>
                        </form>
                    </div>
                </div>
                <script src="javascript/newsletter.js"></script>
            </div>
        </div>
        <div class="legal">
            <a href="View/infoLegal.php#privacidad">Política de privacidad</a>
            <a href="View/infoLegal.php#datos">Recopilación y uso de datos</a>
            <a href="View/infoLegal.php#cookies">Uso de cookies</a>
            <a href="View/infoLegal.php#termsConds">Términos y condiciones</a>
        </div>
    </footer>
</body>

</html>