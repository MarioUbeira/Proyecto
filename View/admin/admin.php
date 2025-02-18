<?php

session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Administrador</title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css">
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Agregamos nuestros estilos personalizados -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header mb-3">
                    <h1>Backend Administrador</h1>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link text-muted" href="#">
                                        <strong>
                                            <?php echo $_SESSION['correo']; ?>
                                        </strong> ha iniciado sesión a las
                                        <?php echo date('H:i:s \d\e\l d/m/Y'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="module">
                    <div class="module-header d-flex justify-content-between align-items-center">
                        <h2>Productos</h2>
                        <a href="productos/editar_productos.html"><button class="btn btn-primary">Modificar</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="module">
                    <div class="module-header d-flex justify-content-between align-items-center">
                        <h2>Usuarios</h2>
                        <a href="usuarios/editar_usuarios.html"><button class="btn btn-primary">Modificar</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="module">
                    <div class="module-header d-flex justify-content-between align-items-center">
                        <h2>Pedidos</h2>
                        <a href="pedidos/visualizar_pedidos.php"><button class="btn btn-primary">Modificar</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="module">
                    <div class="module-header d-flex justify-content-between align-items-center">
                        <h2>BricoTeis</h2>
                        <a href="../../index.php"><button class="btn btn-secondary">
                        Volver</button></a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>