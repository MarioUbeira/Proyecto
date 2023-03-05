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
    public function getUser($email, $password)
    {
        $stmt = $this->conexion()->prepare("SELECT usuarios.Correo, usuarios.Contraseña, usuarios.id_rol FROM `usuarios` WHERE Correo='$email'");
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['Contraseña'])) {
                return $user;
            }
            return false;
        }
        return false;
    }
}

?>