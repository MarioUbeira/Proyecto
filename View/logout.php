<?php
include('sesion.php');
session_destroy();
setcookie("Usuario", "", time() - 200000, "/");
setcookie("Administrador", "", time() - 200000, "/");
setcookie("Sesion-Token", "", time() - 200000, "/");
setcookie("Sesion-Id", "", time() - 200000, "/");
setcookie("Coin", "", time() - 200000, "/");
header("Location: ../index.php");
exit();
?>