<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
/*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */

$db = Conectar::conexion('BTadmin');
$id = $_POST['id'];
$sql = "DELETE FROM usuarios WHERE id_usuario = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
echo "guardado";

?>