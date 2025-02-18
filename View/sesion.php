<script>
    setTimeout(function () {
        document.querySelector('.alerta').remove();
    }, 1000);
</script>
<?php
session_start();
//fav
if (isset($_POST['anadir_fav'])) {
    if (!isset($_SESSION['favoritos'])) {
        $_SESSION['favoritos'] = array();
    }
    // Comprobar si el producto ya está en favoritos
    if (in_array($_POST['id_producto_fav'], $_SESSION['favoritos'])) {
        echo "<div class='alert alert-info alerta' style='text-align:center' role='alert'>El producto ya se encuentra en favoritos.</div>";

    } else {
        array_push($_SESSION['favoritos'], $_POST['id_producto_fav']);
        echo "<div class='alert alert-success alerta' style='text-align:center' role='alert'>Producto añadido a favoritos.</div>";
    }
}
// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    // Si el usuario no está logueado, establecer el rol en 3
    $_SESSION['rol'] = 3;
}
// Errores
ini_set('log_errors', 1);
ini_set('error_log', 'logs/error.log');
// Carrito
if (isset($_POST['anadir'])) {
    $cod = $_POST['cod'];
    $unidades = (int) $_POST['unidades'];
    /* si existe el código sumamos las unidades */
    if (isset($_SESSION['carrito'][$cod])) {
        $_SESSION['carrito'][$cod] += $unidades;
        echo "<div class='alert alert-info alerta' style='text-align:center' role='alert'>El producto ya está en el carrito. Las
    unidades se han actualizado.</div>";
    } else {
        $_SESSION['carrito'][$cod] = $unidades;
        echo "<div class='alert alert-success alerta' style='text-align:center' role='alert'>Producto añadido al carrito.</div>";
    }
    /* actualizamos el contador del carrito */
    $_SESSION['cart_count'] = count($_SESSION['carrito']);
}
?>