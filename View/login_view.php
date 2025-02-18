<?php

namespace View;

use Controllers\Login_controlador;

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'login_modelo.php');
include('..' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'login_controlador.php');
$login_controlador = new Login_controlador();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_controlador->login($_POST['correo'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css" />
    <title>BricoTeis SL</title>
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>

<body>

    <div class="form">
        <h1> Log In </h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input class="form-control" type="email" name="correo"
                    value="<?php echo isset($_GET['correo']) ? $_GET['correo'] : '' ?>" placeholder="Correo" required />
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required class="form-control"
                    placeholder="Contraseña" />
            </div>
            <input type="submit" name="submit" value="Iniciar Sesion" class="btn btn-primary" />
        </form>
        <p>Todavía sin una cuenta? <a href='registro_view.php'>Registrate aquí</a></p>
    </div>
    </div>
    </div>

</body>

</html>