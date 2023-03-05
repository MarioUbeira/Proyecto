<?php
session_start();
// AÑADIR A FAVORITOS
if (isset($_SESSION['mensaje'])) {
    echo '<div class="alerta" id="alerta" style="text-align:center;">' . $_SESSION['mensaje'] . '</div>';
    unset($_SESSION['mensaje']);
}
// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    // Si el usuario no está logueado, establecer el rol en 3
    $_SESSION['rol'] = 3;
}
// Errores
ini_set('log_errors', 1);
ini_set('error_log', 'logs/error.log');

// Verificar si el usuario está logueado
if (isset($_POST['anadir'])) {
    $cod = $_POST['cod'];
    $unidades = (int) $_POST['unidades'];
    /* si existe el código sumamos las unidades */
    if (isset($_SESSION['carrito'][$cod])) {
        $_SESSION['carrito'][$cod] += $unidades;
    } else {
        $_SESSION['carrito'][$cod] = $unidades;
    }
    /* actualizamos el contador del carrito */
    $_SESSION['cart_count'] = count($_SESSION['carrito']);
}
?>
<header>
    <div class="containerH">
        <div class="infoPag">
            <a href="../index.php">
                <img src="../imagenes/Header/Logo.svg" />
                BricoTeis SL
            </a>
        </div>
        <!-- Buscador -->
        <div class="buscador">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <div class="cajaTexto">
                    <input type="text" name="query" name="query" placeholder="Buscar...">
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </div>
        <div class="menuPers">
            <?php if (!isset($_SESSION['correo'])) {
                echo '
                     <div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><a href="../View/registro_view.php"><img src="../imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="../View/login_view.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>
                 </div>';
                require('contador_carrito.php');
            } else {
                echo '<div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="../View/perfil_view.php"><img src="../imagenes/Header/01Menu/edit.svg" />Editar Perfil</a>
                        </div>
                        <div class="subdiv"><a href="../php/logout.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Cerrar Sesión ';

                echo '</div></a>
                    </div>
                </div>
                <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>'
                ;
                require('contador_carrito.php');
            } ?>
        </div>
</header>