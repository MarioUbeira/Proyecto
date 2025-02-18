<?php
namespace Controllers;

use Models\Productos_modelo;

require_once("Model" . DIRECTORY_SEPARATOR . "categorias_modelo.php");

$categoria = new Productos_modelo();
$array_categorias = $categoria->get_categorias();

require_once("View" . DIRECTORY_SEPARATOR . "categorias_view.php");

?>