<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
/*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */
$db = Conectar::conexion('BTadmin');
$cod = $_POST['cod'];
$sql = "DELETE FROM productos WHERE Cod_producto = :cod";
$stmt = $db->prepare($sql);
$stmt->bindParam(':cod', $cod);
$stmt->execute();
echo "guardado";

?>