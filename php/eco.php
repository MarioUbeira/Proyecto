<?php include('header.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/infos.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>


<body>
    <div class="apartados">
        <div class="titulo">
            <h1>Proyecto ECO</h1>
        </div>
        <div class="apartado">
            <p>En BricoTeis SL somos conscientes de la importancia que tiene la contribución de todos -empresas,
                instituciones,
                administraciones públicas y particulares- para promover prácticas responsables que protejan el medio
                ambiente y permitan a la sociedad avanzar hacia un mundo mejor, y por eso hemos integrado una serie de
                principios ambientales dentro de nuestra estrategia empresarial.</p>
        </div>
        <div class="apartado">
            <h2>Control y Reducción del consumo energético</h2>
            <p>Para controlar y reducir el consumo energético, hemos implementado medidas eficientes en la gestión de la
                energía en nuestras instalaciones, como la optimización del uso de la iluminación, la regulación de la
                temperatura y el uso de tecnologías de bajo consumo. Además, fomentamos entre nuestro personal y
                clientes prácticas responsables de consumo energético.</p>
        </div>
        <div class="apartado">
            <h2>Control y Reducción de residuos</h2>
            <p>En BricoTeis SL promovemos la minimización de residuos y la gestión responsable de los mismos, por
                ejemplo, a través de la separación en origen y el reciclaje de materiales. También fomentamos la compra
                de productos con envases y embalajes sostenibles, y nos esforzamos por reducir al mínimo la generación
                de residuos en nuestras operaciones diarias.</p>
        </div>
        <div class="apartado">
            <h2>Formación y educación ambiental</h2>
            <p>La formación y educación ambiental es clave para conseguir una sociedad más sostenible, y por ello, en
                BricoTeis SL llevamos a cabo regularmente actividades de sensibilización y formación sobre temas
                ambientales tanto internamente con nuestro personal como externamente con nuestros clientes y
                proveedores. También colaboramos con entidades y organizaciones dedicadas a la educación ambiental para
                promover una cultura sostenible.</p>
        </div>
        <div class="apartado">
            <h2>Inversión en proyectos sociales</h2>
            <p>En BricoTeis SL nos comprometemos con la responsabilidad social y por ello, invertimos en proyectos
                sociales que contribuyan a mejorar la calidad de vida de nuestra comunidad y a promover un mundo más
                justo e igualitario. Estos proyectos pueden incluir iniciativas en áreas como la educación, el medio
                ambiente y la igualdad de género. Creemos en la importancia de dar algo a la sociedad y creemos que es
                una responsabilidad de las empresas contribuir a mejorar la vida de las personas y el medio ambiente.
            </p>
        </div>
        <div class="apartado">
            <h2>Reducción de la huella de carbono</h2>
            <p>En BricoTeis SL nos esforzamos por reducir nuestra huella de carbono y mitigar los impactos ambientales
                negativos asociados con nuestras operaciones. Esto incluye medidas como la optimización de los procesos
                de producción, la adopción de energías renovables y la reducción de las emisiones de gases de efecto
                invernadero. Trabajamos continuamente para mejorar nuestra eficiencia ambiental y reducir nuestro
                impacto en el medio ambiente.</p>
        </div>
    </div>
    <footer>
        <div class="redes">
            <div class="tituloFooter">
                <h3>Nuestras Redes Sociales</h3>
            </div>
            <div class="contenido">
                <img src="../imagenes/Footer/RRSS/facebook.svg" />
                <img src="../imagenes/Footer/RRSS/twitter.svg" />
                <img src="../imagenes/Footer/RRSS/youtube.svg" />
                <img src="../imagenes/Footer/RRSS/instagram.svg" />
                <img src="../imagenes/Footer/RRSS/linkedin.svg" />
                <img src="../imagenes/Footer/RRSS/pinterest.svg" />
            </div>
        </div>
        <div class="redes">
            <div class="tituloFooter">
                <h3>Proyecto Ecológico</h3>
            </div>
            <div class="contenido">
                <a href="../php/eco.php">
                    <img src="../imagenes/Footer/ECO/Agua.svg" />
                    <img src="../imagenes/Footer/ECO/Reciclaje.svg" />
                    <img src="../imagenes/Footer/ECO/Renovable.svg" />
                </a>
            </div>
        </div>
        <div class="redes">
            <div class="tituloFooter">
                <h3>Pago 100% Seguro</h3>
            </div>
            <div class="contenido">
                <img src="../imagenes/Footer/Pago/Amex.svg" />
                <img src="../imagenes/Footer/Pago/Klarna.svg" />
                <img src="../imagenes/Footer/Pago/Mastercard.svg" />
                <img src="../imagenes/Footer/Pago/Paypal.svg" />
                <img src="../imagenes/Footer/Pago/Visa.svg" />
            </div>
        </div>
        <div class="redes">
            <div class="tituloFooter">
                <h3>Información y Bases Legales</h3>
            </div>
            <div class="contenido">
                <a href="AboutUs.php">About Us</a>
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
                <script src="../javascript/newsletter.js"></script>
                <a href="InfoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>