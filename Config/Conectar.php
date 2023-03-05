<?php
class Conectar
{
    public static function conexion()
    {
        $charset = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); // AÑADIR PARA LAS TILDES Y LOGIN
        try {
            $res = cargar_configuracion(dirname(__FILE__) . DIRECTORY_SEPARATOR . "configuracion" . DIRECTORY_SEPARATOR . "configuracion.xml", dirname(__FILE__) . DIRECTORY_SEPARATOR . "configuracion" . DIRECTORY_SEPARATOR . "configuracion.xsd");
            $conexion = new PDO($res[0], $res[1], $res[2], $charset);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
        return $conexion;
    }


}
function cargar_configuracion($xml, $validador)
{
    $config = new DOMDocument();
    $config->load($xml);
    $res = $config->schemaValidate($validador);
    if ($res === FALSE) {
        throw new InvalidArgumentException("ERROR en el fichero de configuración");
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
?>