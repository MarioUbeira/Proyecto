<?php
include('sesion.php');
// Eliminar producto de favoritos
if (isset($_POST['eliminar_fav'])) {
    $id_producto = $_POST['eliminar_fav'];
    // Buscar el índice del producto en el array de favoritos
    $indice = array_search($id_producto, $_SESSION['favoritos']);
    $_POST['anadir_fav'] = [];
    if ($indice !== false) {
        // Eliminar el producto del array
        unset($_SESSION['favoritos'][$indice]);
        // Redirigir para actualizar la página
        header("Location: favoritos.php");
    }
}
?>