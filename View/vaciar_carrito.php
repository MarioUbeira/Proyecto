<?php
include('sesion.php');
unset($_SESSION['carrito']);
unset($_SESSION['cart_count']);
header("Location: carrito.php");

?>