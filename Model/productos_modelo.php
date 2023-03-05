<?php

class Productos_model
{

    private $db;
    private $productos;

    /**
     * __construct Implementa la conexion con la bd, y asigna un array a productos
     *
     */
    public function __construct()
    {
        require_once "Config" . DIRECTORY_SEPARATOR . "Conectar.php";
        $this->db = Conectar::conexion();
        $this->productos = array();
    }

    /**
     * get_productos realiza una consulta en la base de datos en la que destados = 1 para mostrar los productos destacados y los va devolviendo en un array 
     *
     * @return  [array] return array de productos
     */
    public function get_productos()
    {

        $consulta = $this->db->query("SELECT * FROM productos WHERE destacado=1");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }

}
function cargar_categorias($cat)
{
    include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
    /*
     * Devuelve un puntero con el código y nombre de las categorías de la BBDD
     * o falso si se produjo un error
     */

    $db = Conectar::conexion();
    $ins = "SELECT Cod_producto,Nombre,Precio,Stock FROM productos WHERE Categoria='$cat'";
    $resul = $db->query($ins);
    return $resul;
}

function cargar_producto($cod)
{
    include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
    $db = Conectar::conexion();
    $ins = "SELECT * FROM productos WHERE Cod_producto='$cod'";
    $resul = $db->query($ins);
    return $resul;
}

function insertar_pedido($carrito, $usuario)
{

    $bd = Conectar::conexion();
    $bd->beginTransaction();
    try {
        $hora = date("Y-m-d");
        // insertar el pedido
        $sql1 = "insert into pedidos(fecha,usuario) 
			values('$hora',$usuario)";
        $bd->query($sql1);

        // coger el id del nuevo pedido para las filas detalle
        $pedido = $bd->lastInsertId();
        // insertar las filas en pedidoproductos
        foreach ($carrito as $codProd => $unidades) {
            $stmt = $bd->query("Select stock, nombre from productos where Cod_producto=$codProd");
            list($stock, $nombreproducto) = $stmt->fetch();
            if ($stock < $unidades) {
                throw new PDOException($nombreproducto  . "<div class='alert-error alert'> No se ha podido realizar el producto.</div>");
            }
            $sql4 = "UPDATE productos set stock=? where Cod_producto=?";
            $stmt = $bd->prepare($sql4);
            $stock -= $unidades;
            $stmt->execute(array($stock, $codProd));

            $sql2 = "insert into pedidosproductos(Cod_pedido, Cod_producto, Unidades) 
		             values( ?, ?, ?)";
            $stmt = $bd->prepare($sql2);
            $stmt->execute(array($pedido, $codProd, $unidades));
        }
        $bd->commit();
        unset($stmt);
        return $pedido; //devuelve el código del nuevo pedido
    } catch (PDOException $e) {
        echo $e->getMessage();
        $bd->rollback();
        return FALSE;
    } finally {
        unset($bd);
    }
}
function insertar_carrito($codigosProductos)
{
    $bd = Conectar::conexion();
    $placeholders = implode(',', array_fill(0, count($codigosProductos), '?'));
    $stmt = $bd->prepare("SELECT * FROM productos WHERE Cod_producto IN ($placeholders)");

    // bind the parameters
    $stmt->execute($codigosProductos);
    $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$resul) {
        return FALSE;
    }

    return $resul;
}