<?php

require_once('../Model/usuario_modelo.php');

class loginController
{
    public function login($email, $password)
    {
        $user = (new User)->getUser($email, $password);

        if (is_array($user)) {
            $_SESSION['correo'] = $email;
            $_SESSION['rol'] = $user['id_rol'];

            if ($_SESSION['rol'] == 2) {
                header('Location: admin.php');
                exit;
            } else {
                header('Location: ../index.php');
                exit;
            }
        } else {
            echo '<div class="alert alert-danger" role="alert" style="text-align:center;">Usuario/Contraseña Incorrectos</div>';
        }
    }
}
?>