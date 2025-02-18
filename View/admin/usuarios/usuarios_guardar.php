<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$db = Conectar::conexion('BTadmin');
$id = $_POST['id'];
$nom = $_POST['nombre'];
$ape = $_POST['apellidos'];
$cor = $_POST['correo'];
$tel = $_POST['telefono'];
$rol = $_POST['rol'];

$sql = "UPDATE usuarios SET Nombre=:nom, Apellidos=:ape, Correo=:cor, Telefono=:tel, id_rol=:rol WHERE id_usuario=:id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':ape', $ape);
$stmt->bindParam(':cor', $cor);
$stmt->bindParam(':tel', $tel);
$stmt->bindParam(':rol', $rol);
$stmt->bindParam(':id', $id);
$stmt->execute();

echo "guardado";

?>