<?php
namespace Models;
use Config\Conectar;
class Login_modelo
{
    /**
     * @brief getUser funcion que obtiene de la base de datos el correo y la contrasña del usuario
     *  y verifica si la contraseña introducida es la misma que la introducida pero hasheada,
     * devuelve falso si la conexión no es correcta.
     *
     * @param   string  $email     [$email correo del usuario]
     * @param   string  $password  [$password contraseña del usuario]
     *
     * @return  boolean             [return $user en caso de que sea correcto, y false en caso de que no sean las mismas]
     */
    public function loguearUsuario($email, $password)
    {
        $user = [];
        $con = Conectar::conexion('busuario');
        $stmt = $con->prepare("SELECT id_usuario, Correo, Contraseña, id_rol FROM `usuarios` WHERE Correo=:email");
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Contraseña'])) {
            if ($user['id_rol'] == 2) {
                $user['usuario_con'] = 'BTadmin';
            } else {
                $user['usuario_con'] = 'busuario';
            }
            return $user;
        }
        return false;
    }
    /**
     * @brief Obtiene el nombre del usuario a partir de su correo.
     * @param string $email Correo del usuario.
     * @return string Nombre del usuario.
     */
    public static function getNombreUsuario($email)
    {
        $con = Conectar::conexion('busuario');
        $stmt = $con->prepare("SELECT nombre FROM `usuarios` WHERE correo=:email");
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user['nombre'];
    }
}
?>