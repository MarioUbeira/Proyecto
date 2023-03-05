<?php
include('../../../Config/Conectar.php');

$db = Conectar::conexion();

$cod = $_POST['cod'];
$nom = $_POST['nombre'];
$des = $_POST['descripcion'];
$pre = $_POST['precio'];
$stk = $_POST['stock'];
$cat = $_POST['categoria'];
$dsD = $_POST['descripcionD'];
$dsT = $_POST['destacado'];

$sql = "UPDATE productos SET Nombre=:nom, Descripcion=:des, Precio=:pre, Stock=:stk, Categoria=:cat, Descripcion_detallada=:dsD, Destacado=:dsT WHERE Cod_producto=:cod";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':des', $des);
$stmt->bindParam(':pre', $pre);
$stmt->bindParam(':stk', $stk);
$stmt->bindParam(':cat', $cat);
$stmt->bindParam(':dsD', $dsD);
$stmt->bindParam(':dsT', $dsT);
$stmt->bindParam(':cod', $cod);
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