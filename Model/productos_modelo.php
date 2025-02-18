<?php
namespace Models;


use Config\Conectar;

class Productos_modelo
{
    private $productos;
    private $categorias;
    public function __construct()
    {
        $this->productos = array();
        $this->categorias = array();
    }
    /**
    *@brief Obtiene todos los productos de la base de datos.
    *@return array Un array con todos las productos obtenidas.
    
    */
    public function get_productos()
    {
        include 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php';
        $con = Conectar::conexion('busuario');
        $consulta = $con->query("SELECT * FROM productos WHERE destacado=1");
        while ($row = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }


    /**
     * @brief Obtiene los productos de la base de dato.
     *
     * @param string $cod El codigo del producto que se quiere obtener.
     *
     * @return \PDOStatement|false Devuelve un objeto \PDOStatement que contiene los productos o false si ocurre un error.
     */
    public static function cargar_producto($cod)
    {
        include '../Config' . DIRECTORY_SEPARATOR . 'Conectar.php';

        $db = Conectar::conexion('busuario');
        $ins = "SELECT * FROM productos WHERE Cod_producto='$cod'";
        $resul = $db->query($ins);
        return $resul;
    }
    /**
     * @brief inserta un pedido en la base de datos y devuelve el código del pedido insertado.
     *
     * @param   array  $carrito  Carrito de compras con los productos a insertar.
     * @param   int  $usuario    Id del usuario que realiza el pedido.
     *
     * @return   int|false          El código del pedido insertado o FALSE si no se ha podido insertar.
     */
    public static function insertar_pedido($carrito, $usuario)
    {

        $bd = Conectar::conexion('busuario');
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
                    throw new \PDOException($nombreproducto . "<div class='alert-error alert'> No se ha podido realizar el producto.</div>");
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
        } catch (\PDOException $e) {
            echo $e->getMessage();
            $bd->rollback();
            return FALSE;
        } finally {
            unset($bd);
        }
    }
    /**
     * 
     * @brief Inserta productos en el carrito de compras
     *
     * @param array $codigosProductos Array con los códigos de productos a insertar
     *
     * @return mixed Retorna FALSE si no encuentra resultados, o un array con los productos encontrados.
     *
     */
    public static function insertar_carrito($codigosProductos)
    {
        $bd = Conectar::conexion('busuario');
        $placeholders = implode(',', array_fill(0, count($codigosProductos), '?'));
        $stmt = $bd->prepare("SELECT * FROM productos WHERE Cod_producto IN ($placeholders)");

        // bind the parameters
        $stmt->execute($codigosProductos);
        $resul = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$resul) {
            return FALSE;
        }

        return $resul;
    }

    /**
    *@brief Obtiene todas las categorias de la base de datos.
    *@return array Un array con todas las categorias obtenidas.
    
    *@throws \Exception Si ocurre algún error durante la consulta.
    */
    public function get_categorias()
    {
        try {
            $con = Conectar::conexion('busuario');
            $consulta = $con->query("SELECT * FROM categorias");
            while ($row = $consulta->fetch(\PDO::FETCH_ASSOC)) {
                $this->categorias[] = $row;
            }
            return $this->categorias;
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
        }

    }

    /**
     * @brief Obtiene los productos de una categoría específica.
     *
     * @param string $cat La categoría de la que se quieren obtener los productos.
     *
     * @return \PDOStatement|false Un objeto \PDOStatement que contiene los productos o false si ocurre un error.
     */
    public static function cargar_categorias($cat)
    {
        include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
        $db = Conectar::conexion('busuario');
        $ins = "SELECT Cod_producto,Nombre,Precio,Stock FROM productos WHERE Categoria='$cat'";
        $resul = $db->query($ins);
        return $resul;
    }
}