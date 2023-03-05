<?php

require_once("Model" . DIRECTORY_SEPARATOR . "categorias_modelo.php");

$categoria = new Categorias_model();
$array_categorias = $categoria->get_categorias();

require_once("View" . DIRECTORY_SEPARATOR . "categorias_view.php");

?>