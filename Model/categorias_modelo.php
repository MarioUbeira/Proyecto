<?php

class Categorias_model
{

    private $db;
    private $categorias;

    /**
     * [__construct Implementa la conexion con la bd, y asigna un array a categorias]
     *
     */
    public function __construct()
    {
        require_once("..". DIRECTORY_SEPARATOR ."Config". DIRECTORY_SEPARATOR ."Conectar.php");
        $this->db = Conectar::conexion();
        $this->categorias = array();
    }
    /**
     * [get_categorias realiza una consulta en la base de datos en la tabla de categorias los va devolviendo en un array ]
     *
     * @return  [array]  [return array de categorias]
     */
    public function get_categorias()
    {

        $consulta = $this->db->query("SELECT * FROM categorias");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias[] = $row;
        }
        return $this->categorias;
    }


}


?>