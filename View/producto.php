<?php
include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
use Models\Productos_modelo;

include('sesion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/producto.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    include('header.php');
    $producto_modelo = new Productos_modelo();
    $productos = $producto_modelo::cargar_producto($_GET['codigo']);
    echo "<div class='contenedor'>";
    foreach ($productos as $producto) {
        $cod = $producto['Cod_producto'];
        $cod_formateado = str_pad($cod, 5, '0', STR_PAD_LEFT);
        $nom = $producto['Nombre'];
        $pre = $producto['Precio'];
        $desc = $producto['Descripcion'];
        $stock = $producto['Stock'];
        $precio_formateado = number_format($pre, 2);
        $sinIVA_formateado = number_format($pre / 1.21, 2);
        /*
         * Dentro del formulario hay un campo oculto para enviar el código del producto
         * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
         */
        echo "<div class='producto'>
        <div class='infoProd'>
                <label class='nomProd'>$nom</label>
                <label class='refProd'>Ref: $cod_formateado</label>
                <label class='descProd'>$desc</label>
                </div>
                <div class='imgProd'>    
                <img src='../imagenes/Productos/{$cod}.png'></img>    
        </div>
        <div class='detProd'>   
          <div class='cajaProd'>                    
                <label class='precio'>$precio_formateado €/Ud IVA Incluido</label>
                <label class='sinIva'>$sinIVA_formateado €/Ud sin IVA</label>
                <label class='entrega'><span class='check'>✓</span> Envío <span class='check'>✓</span> Recogida <span class='check'>✓</span> Almacén</label>
                <div class='button'>
                <form class='fav' method='post'>
          <input type='hidden' name='id_producto_fav' value='{$producto['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' class='uds' type='number' min = '1' max='{$producto['Stock']}' value = '1' onkeydown='return false'>
            </form>
                </div>
                <label class='stock'><span class='stock-num'>$stock</span> unidades en Stock</label>
            </div>
        </div>
            </div>";
    }
    echo "</div>";

    ?>
    <script src="../javascript/cantidadProd.js"></script>
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
                <a href="eco.php">
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
            <h3>Manténte al día</h3>
            </div>
            <div class="contenido">
                <a href="aboutUs.php">About Us</a>
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
            </div>
        </div>
        <div class="legal">
            <a href="infoLegal.php#privacidad">Política de privacidad</a>
            <a href="infoLegal.php#datos">Recopilación y uso de datos</a>
            <a href="infoLegal.php#cookies">Uso de cookies</a>
            <a href="infoLegal.php#termsConds">Términos y condiciones</a>
        </div>
    </footer>
</body>

</html>