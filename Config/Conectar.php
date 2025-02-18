<?php

namespace Config;

use \PDO;
use \Exception;

class Conectar
{
    /**
     * @brief Método estático que establece la conexión a la base de datos.
     * @param string $usuario Nombre de usuario de la base de datos.
     * @return PDO Retorna un objeto PDO que representa la conexión a la base de datos.
     */
    public static function conexion($usuario)
    {
        $charset = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); // AÑADIR PARA LAS TILDES Y LOGIN
        try {
            $conectar = new Conectar();
            $res = $conectar->cargar_configuracion(dirname(__FILE__) . DIRECTORY_SEPARATOR . "configuracion" . DIRECTORY_SEPARATOR . "configuracion.xml", dirname(__FILE__) . DIRECTORY_SEPARATOR . "configuracion" . DIRECTORY_SEPARATOR . "configuracion.xsd");
            $conexion = new PDO($res[0], $usuario, $res[2], $charset);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
        return $conexion;
    }

    /**
     * @brief Método que carga la configuración de la base de datos desde un archivo XML.
     * @param  $xml Ruta del archivo XML de configuración.
     * @param $xsd Ruta del archivo XSD que valida el archivo XML de configuración.
     * @return array Retorna un array con los datos de conexión a la base de datos (nombre de la base de datos, dirección IP, usuario y contraseña).
     */
    public function cargar_configuracion($xml, $validador)
    {
        $config = new \DOMDocument();
        $config->load($xml);
        $res = $config->schemaValidate($validador);
        if ($res === FALSE) {
            throw new \InvalidArgumentException("ERROR en el fichero de configuración");
        }
        $datos = simplexml_load_file($xml);
        $ip = $datos->xpath("//ip");
        $nombre = $datos->xpath("//nombre");
        $usuario = $datos->xpath("//usuario");
        $clave = $datos->xpath("//clave");
        $conexion = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
        $resul = [];
        $resul[] = $conexion;
        $resul[] = $usuario[0];
        $resul[] = $clave[0];
        return $resul;
    }
}
?>