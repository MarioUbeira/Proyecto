<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Finalizar pedido</title>
    <link href="../css/finalizar_compra.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>
<?php
session_start();
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'login_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'correo_modelo.php');
// OBTENER NOMBRE DEL USUARIO
$nombre = getNombreUsuario($_SESSION['correo']);
$cod_producto = $_SESSION['carrito'];
$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']);
$total = 0;
if ($resul === FALSE) {
    echo "<div class='alert-warning alert' role='alert'> No se ha podido realizar el producto.</div>";
    header("LOCATION:" . $_SERVER['HTTP_REFERER'] . "");
} else {
    $correo = $_SESSION['correo'];
    echo "<div class='alert-success alert'style='text-align:center' role='alert'> Pedido realizado con éxito. Se enviará un correo de confirmación a: <strong> $correo </strong>  </div>";
    enviar_correo($correo, $nombre, "Pedido realizado", "Gracias " . $nombre . " por realizar el pedido en BricoTeis.");

    $cons = Conectar::conexion()->query("SELECT productos.nombre, productos.precio, pedidosproductos.unidades 
    FROM productos 
    JOIN pedidosproductos ON productos.cod_producto = pedidosproductos.cod_producto 
    WHERE pedidosproductos.cod_pedido = $resul");
    $productos = $cons->fetchAll(PDO::FETCH_ASSOC);
    foreach ($productos as $producto) {
        $nom = $producto['nombre'];
        $precio = $producto['precio'];
        $unidades = $producto['unidades'];
        $total += ($precio * $unidades);
    }
    //Vacia el carrito pues o bien se hizo el pedido o bien hubo un error
    $_SESSION['carrito'] = [];
    $_SESSION['count_cart'] = count($_SESSION['carrito']);

    // Actualiza el valor de count_cart a 0 después de vaciar el carrito
    if ($_SESSION['count_cart'] === 0) {
        $_SESSION['count_cart'] = 0;
    }

}
//   IVA + ENVIO 
$total += ($total * 0.21) + 3;
?>
<!DOCTYPE html>
<html lang="es">
<script>
    function imprimir() {
        window.print();
    }
</script>

<body id="pagina-imprimir">
    
    <div class="container">
    

        <div class="header">
            <img src="../imagenes/Logo.ico" alt="Logo" class="logo">
            <div class="info">
            <button class="btn btn-light boton-imprimir" onclick="imprimir()">Imprimir🖨️</button><br><br>
                <p>BricoTeis SL</p>
                <p>CIF: B12345678</p>
                <p>Dirección: Teis, 12</p>
                <p>Teléfono: 777 666 777</p>
            </div>
        </div>
        <table>
            <tr>
                <th>Cliente: </th>
                <td>
                    <?php echo $nombre ?>
                </td>
            </tr>
            <tr>
                <th>Fecha: </th>
                <td>
                    <?php echo date("Y-m-d") ?>
                </td>
            </tr>
            </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Precio unitario</th>
                <th class="text-center">Unidades</th>
                <th class="text-center">Total<div class='small'>Iva + envío incluido</div>
                </th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td class="text-center">
                        <?php echo $producto['nombre']; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $producto['precio']; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $producto['unidades']; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        echo $producto['precio'] * $producto['unidades'];
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"></td>
                <td class="text-center">
                    <strong>
                        <?php echo number_format($total, 2) . "€"; ?>
                    </strong>
                </td>
            </tr>
        </table>

        <div class="legal">
            <p>Este documento es una factura electrónica y tiene la misma validez legal que una factura en papel.
            </p>
            <p>Powered by BricoTeis SL</p>
        </div>
    </div>
    <div class="boton-imprimir">
        <a href="../index.php"><button class='btn-warning btn'>Volver</button></a>
    </div>
</body>

</html>