<?php
use Config\Conectar;
    try {
    require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
        $db = Conectar::conexion('BTadmin');
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
    echo "guardado";
} catch (\PDOException $e) {
    // Si ocurre un error de PDO, lo capturamos y mostramos un mensaje al usuario
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>