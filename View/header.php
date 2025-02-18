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
                    <button type="submit">
                        <div class="lupa"><img src="../imagenes/Header/lupa.svg" /></div>
                    </button>
                </div>
            </form>
        </div>
        <div class="menuPers">
            <?php if (!isset($_SESSION['correo'])) {
                echo '
                     <div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                         <div class="subdiv"><button><a href="..' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'registro_view.php"><img src="../imagenes/Header/01Menu/register.svg" /><div class="subText">REGISTRARSE</div></a></button>
                             </div>
                             <div class="subdiv"><button><a href="..' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'login_view.php"><img src="../imagenes/Header/01Menu/entrance.svg" /><div class="subText">INICIAR SESIÓN</div></a></button></div>
                         </div>
                     </div>
                     <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
    <div class="carrito"><a href ="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>';
                require('contador_carrito.php');
                ;
                '</div>';
            } else {
                echo '<div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                    <div class="subdiv"><button><a href="..' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'perfil_controlador.php"><img src="../imagenes/Header/01Menu/edit.svg" /><div class="subText">EDITAR PERFIL</div></button></a>
                    </div>
                    <div class="subdiv"><button><a href="logout.php"><img src="../imagenes/Header/01Menu/exit.svg" /><div class="subText">CERRAR SESIÓN</div></a></button> ';
                echo '</div>
                    </div>
                </div>
                <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg"/>Favoritos</a></div>
                <div class="carrito"><a href ="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg"/>Carrito</a>
                <div class="subcarrito">
                </div>';
                require('contador_carrito.php');
                '</div>';
            } ?>
        </div>
</header>