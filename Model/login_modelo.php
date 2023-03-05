<?php

class User extends Conectar
{
    /**
     * [getUser funcion que obtiene de la base de datos el correo y la contrasña del usuario
     *  y verifica si la contraseña introducida es la misma que la introducida pero hasheada,
     * devuelve falso si la conexión no es correcta.]
     *
     * @param   [string]  $email     [$email correo del usuario]
     * @param   [string]  $password  [$password contraseña del usuario]
     *
     * @return  [boolean]             [return $user en caso de que sea correcto, y false en caso de que no sean las mismas]
     */
    public function loguearUsuario($email, $password)
    {
        $stmt = $this->conexion()->prepare("SELECT id_usuario,Correo, Contraseña, id_rol FROM `usuarios` WHERE Correo=:email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Contraseña'])) {
            return $user;
        }

        return false;
    }
}

/**
 * Obtiene el nombre del usuario a partir de su correo
 *
 * @param   [type]  $email  $email correo del usuario
 *
 * @return  [type]          return $user['Nombre'] nombre del usuario
 */
function getNombreUsuario($email)
{
    $stmt = Conectar::conexion()->prepare("SELECT nombre FROM `usuarios` WHERE correo=:email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['nombre'];
}



?>

