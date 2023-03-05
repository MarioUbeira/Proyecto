<?php

require_once("Model". DIRECTORY_SEPARATOR ."productos_modelo.php");

$producto = new Productos_model();
$array_productos = $producto->get_productos();

require_once("View". DIRECTORY_SEPARATOR ."productos_view.php");

?>