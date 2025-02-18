<?php
namespace Controllers;

use Models\Productos_modelo;

require_once("Model" . DIRECTORY_SEPARATOR . "productos_modelo.php");

$producto = new Productos_modelo();
$array_productos = $producto->get_productos();

require_once("View" . DIRECTORY_SEPARATOR . "productos_view.php");

?>