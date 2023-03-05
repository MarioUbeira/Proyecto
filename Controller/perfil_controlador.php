<?php

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'perfil_modelo.php');

session_start();

if (isset($_SESSION['correo'])) {
    $email = $_SESSION['correo'];

    // Creamos una instancia del modelo
    $perfil = new Perfil();

    // Obtenemos los datos del usuario
    $valores = $perfil->obtenerUsuario($email);

    $nombre = $valores['nombre'];
    $apellidos = $valores['apellidos'];
    $correo = $valores['correo'];
    $rol = $valores['descripcion'];
    $fecha_nacimiento = $valores['fecha_nacimiento'];
    $fecha_registro = $valores['fecha_registro'];

    if (isset($_POST['nombre']) && isset($_POST['apellidos'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];

        // Actualizamos el nombre y apellidos del usuario
        $perfil->actualizarNombre($email, $nombre, $apellidos);
    }

    if (isset($_POST['telefono'])) {
        $telefono = $_POST['telefono'];

        // Actualizamos el teléfono del usuario
        $perfil->actualizarTelefono($email, $telefono);
    }

} else {
    echo "Por favor, inicia sesión";
    header("Location:..". DIRECTORY_SEPARATOR ."index.php");
}

include('..'. DIRECTORY_SEPARATOR .'View'. DIRECTORY_SEPARATOR .'perfil_view.php');