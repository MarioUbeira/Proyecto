<?php
/* comprueba que el usuario haya abierto sesión o redirige */
session_start();
$cod = $_POST['cod'];
$unidades = $_POST['unidades'];
/* si existe el código restamos las unidades, con mínimo de 0 */
if (isset($_SESSION['carrito'][$cod])) {
    $_SESSION['carrito'][$cod] -= $unidades;
    if ($_SESSION['carrito'][$cod] <= 0) {
        unset($_SESSION['carrito'][$cod]);
    }
    /* actualizamos el contador del carrito */
    $_SESSION['cart_count'] = count($_SESSION['carrito']);
}
header("Location: carrito.php");