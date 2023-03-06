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