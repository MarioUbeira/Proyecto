<?php
include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/productos.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="contCats">
        <button id="toggleMenuCat"> ≡ </button>
        <div class="menuCat">
            <input type="button" class="categoria" value="Tejados Y Cubiertas" />
            <input type="button" class="categoria" value="Arenas y Gravas" />
            <input type="button" class="categoria" value="Cementos Y Morteros" />
            <input type="button" class="categoria" value="Madera" />
            <input type="button" class="categoria" value="Hormigoneras, carretillas..." />
            <input type="button" class="categoria" value="Cercados y Ocultación" />
            <input type="button" class="categoria" value="Yesos Y Escayolas" />
            <input type="button" class="categoria" value="Elementos de construcción" />
            <input type="button" class="categoria" value="Aislamientos" />
        </div>
        <script src="../javascript/menuLat.js"></script>
        <div class="mostrar">
            <?php
            include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
            $productos = cargar_categorias($_GET['categoria']);
            echo "<div class='productos'>";
            foreach ($productos as $producto) {
                $cod = $producto['Cod_producto'];
                $nom = $producto['Nombre'];
                $pre = $producto['Precio'];
                $stock = $producto['Stock'];
                $precio_formateado = number_format($pre, 2);
                /*
                 * Dentro del formulario hay un campo oculto para enviar el código del producto
                 * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
                 */
                echo "<div class='producto'>
                        <a href='producto.php?codigo=" . $cod . "'>
                        <img src='../imagenes/Productos/{$cod}.png'></img>   
                        </a>                
                        <label>$nom</label>
                        <label>$precio_formateado €/Ud</label>
                        <div class='button'>
                        <form class='fav' method='post' action='php/favoritos.php'>
          <input type='hidden' name='id_producto_fav' value='{$producto['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' type='number' min = '1' max='$stock' value = '1'>
            </form>
                        </div>
                    </div>";
            }
            echo "</div>";
            ?>
        </div>
        <script>
            const editButtons = document.querySelectorAll(".categoria");
            editButtons.forEach(editBtn => editBtn.addEventListener("click", () => select_productos(editBtn.value)));

            function select_productos(value) {
                console.log(value);
                $.ajax({
                    data: {
                        "categoria": value
                    },
                    method: "POST",
                    url: "select_productos.php"
                })
                    .done(function (response) {
                        console.log(response);
                        $("div.mostrar").html(response);
                        //document.getElementsByClassName('botoncito').addEventListener('click',mostrar);
                        //const editButtons = document.querySelectorAll(".btn-info");
                        //editButtons.forEach(editBtn => editBtn.addEventListener("click", () => mostrar(editBtn.parentNode)));

                    });
            }
        </script>
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
                <a href="../php/AboutUs.php">About Us</a>
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
                <a href="../php/InfoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>