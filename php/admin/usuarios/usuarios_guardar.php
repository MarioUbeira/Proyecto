<?php
include('../../../Config/Conectar.php');

$db = Conectar::conexion();

function comprobarCorreo($db, $correo){
    $consulta = "SELECT * FROM usuarios WHERE Correo=:cor";

}

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

//$query = $con->query("UPDATE productos SET Nombre='$nom', Descripcion='$des', Precio='$pre', Stock='$stk', Categoria='$cat', Descripcion_detallada='$dsD' ,Destacado='$dsT' WHERE Cod_producto='$cod'");
//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
echo "guardado";

?>