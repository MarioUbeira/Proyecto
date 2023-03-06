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