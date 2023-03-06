<?php
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
include("sesion.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <title>BricoTeis SL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>
<body>
<?php
include('header.php');
$total = 0;
if ($_SESSION['rol'] == 3) {
    echo "<div class='card'><div class='card-body'>
            <div class='alert-warning alert'>  Debes iniciar sesión primero para realizar una compra.
            </div></div></div>";
} elseif (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $productos = insertar_carrito(array_keys($_SESSION['carrito']));
    if ($productos === FALSE) {
        echo "<div class='alert alert-danger' role='alert'>
        No hay productos en el carrito.
    </div>";
        exit;
    }
    $productos = insertar_carrito(array_keys($_SESSION['carrito']));
    if ($productos === FALSE) {
        echo "<div class='alert alert-danger' role='alert'>
        No hay productos en el carrito.
    </div>";
        exit;
    }


    echo "<h2>Carrito de la compra</h2>";
    echo "<div class='row'>";
    echo "<div class='col-12 col-md-8'>";
    foreach ($productos as $producto) {
        $cod = $producto['Cod_producto'];
        $nom = $producto['Nombre'];
        $precio = $producto['Precio'];
        $stock = $producto['Stock'];
        if (isset($_SESSION['carrito'][$cod])) {
            $unidades = $_SESSION['carrito'][$cod];
            $total += $unidades * $precio;
            echo "<div class='row border rounded mb-3'>";
            echo "<div class='col-3'>";
            echo "<img src='../imagenes/Productos/{$cod}.png' class='img-fluid'>";
            echo "</div>";
            echo "<div class='col-9'>";
            echo "<h4 class='card-title'>$nom</h4><br>";
            echo "<p class='small'>Stock: $stock</p>";
            echo "<p class='card-text'>Unidades: $unidades</p>";
            echo "<p class='card-text'>Precio unitario: $precio €</p>";

            echo " <div class='btn-group-vertical'>
            <form class='troll' method='post'>
                <input name='unidades' type='number' min='1' max='{$producto['Stock']}' value='1'>
                <input type='submit' class='btn btn-warning' name='anadir' value='Añadir'>
                <input name='cod' type='hidden' value='$cod'>
            </form>
            <form action='eliminar_producto.php' method='POST'>
                <input name='unidades' type='number' min='1' max='$unidades' value='1'>
                <input type='submit' value='Eliminar' class='btn btn-danger'>
                <input name='cod' type='hidden' value='$cod'>
            </form>
        </div>";
            echo "</div>";
            echo "</div>";
        }
    }
    echo "</div>";
    echo "<div class='col-12 col-md-4'>";
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h4 class='card-title'>Detalles del pedido</h4>";
    echo "<hr>";
    echo "<div>";
    echo "<h6>Subtotal</h6>";
    echo "<p class='card-text'>" . (isset($total) ? $total . "€" : "0€") . "</p>";
    echo "</div>";
    echo "<div>";
    echo "<h6>IVA (21%)</h6>";
    echo "<p class='card-text'>" . (isset($total) ? $iva = number_format($total * 0.21, 2) . "€" : "0€") . "</p>";
    echo "</div>";
    echo "<div>";
    echo "<h6>Envío</h6>";
    echo "<p class='card-text'>3€</p>";
    echo "</div>";
    echo "<hr>";
    echo "<div>";
    echo "<h6>Total</h6>";
    echo "<p class='card-text'>" . (isset($total) ? number_format($total * 1.21 + 3, 2) . "€" : "3€") . "</p>";
    echo "</div>";
    echo "<a href='finalizar_compra.php' class='btn btn-primary btn-block'>Realizar pedido</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<div class='alert alert-danger' role='alert'>
        No hay productos en el carrito.
    </div>";
}
?>
</body>

</html>