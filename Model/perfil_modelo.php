<?php
class Perfil extends Conectar
{
    public function obtenerUsuario($email)
    {
        $stmt = Conectar::conexion()->prepare("SELECT usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.fecha_nacimiento, usuarios.fecha_registro,usuarios.Telefono ,roles.descripcion 
                                        FROM usuarios
                                        LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
                                        WHERE correo='$email'");
        $stmt->execute();
        $valores = $stmt->fetch();
        return $valores;
    }

    public function actualizarNombre($email, $nombre, $apellidos)
    {
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos' WHERE correo = '$email'");
        $stmt->execute();
    }

    public function actualizarTelefono($email, $telefono)
    {
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET telefono = '$telefono' WHERE correo = '$email'");
        $stmt->execute();
    }
}