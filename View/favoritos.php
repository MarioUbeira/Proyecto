<?php
use Config\Conectar;

include('sesion.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>
<style>
    .btn-custom {
        background-color: #00b3aa;
        color: #00b3aa;
    }

    .btn-custom:hover {
        background-color: #00b3aa;
        color: #00b3aa;
    }

    #col-botones {
        height: 50px;
    }
</style>

<body class="bg-light">
    <div class="container-fluid">

        <?php
        include('header.php');


        if (isset($_SESSION['favoritos'])) {
            // Obtener detalles de los productos en favoritos
            $favoritos = array();
            foreach ($_SESSION['favoritos'] as $id_producto) {
                // Obtener información del producto de la base de datos
                $query = "SELECT Cod_producto, nombre, precio,descripcion FROM productos WHERE Cod_producto = :id_producto";
                $con = Conectar::conexion('busuario');
                $stmt = $con->prepare($query);
                $id_producto = intval($id_producto);
                $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt->execute();
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                // Agregar producto al array de favoritos
                array_push($favoritos, $producto);
            }
            echo "<h2>Productos Favoritos</h2>";
            // Mostrar productos en favoritos
            if (count($favoritos) > 0) {
                foreach ($favoritos as $producto) {
                    $cod = $producto['Cod_producto'];

                    echo "<table class='table text-center'>";
                    echo "<thead><tr><th class='col-1'>Imagen</th><th class='col-1'>Nombre</th><th class='col-1'>Descripción</th><th class='col-1'>Precio</th><th class='col-1'></th></tr></thead>";
                    echo "<tbody>";
                    echo "<tr><td class='col-1'><img class='img-thumbnail' src='../imagenes/Productos/{$producto['Cod_producto']}.png'></td><td class='col-1'>{$producto['nombre']}</td><td class='col-1'>{$producto['descripcion']}</td><td class='col-1'>{$producto['precio']}€</td>";
                    echo "<td class='col-1'>";
                    // Formulario para eliminar el producto
                    echo "<form method='post' action='eliminar_favorito.php'>";
                    echo "<input id='col-botones' type='hidden' name='eliminar_fav' value='{$producto['Cod_producto']}' />";
                    echo "<button type='submit' class='btn btn-danger'>🗑️</button>";
                    echo "</form>";
                    echo " <form class='troll' method='post'>
                    <input name = 'unidades' type='hidden' min = '1'  value = '1'>
                    <input type = 'submit' class='btn-custom btn' name='anadir' value='🛒'><input name ='cod' type='hidden' value = '$cod'></input>
                    
                  </form>
                    </form></form></form></td></tr>";
                    echo "</tbody>";
                    echo "</table>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
        No hay productos en favoritos.
    </div>";
            }

        } else {
            echo "<div class='alert alert-danger' role='alert'>
            No hay productos en favoritos.
        </div>";
        }
        // Eliminar producto de favoritos
        if (isset($_POST['eliminar_fav'])) {
            $id_producto = $_POST['eliminar_fav'];
            // Buscar el índice del producto en el array de favoritos
            $indice = array_search($id_producto, $_SESSION['favoritos']);
            $_POST['anadir_fav'] = [];
            if ($indice !== false) {
                // Eliminar el producto del array
                unset($_SESSION['favoritos'][$indice]);
                // Redirigir para actualizar la página
        
                if ($_POST['anadir_fav']) {

                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        ?>
    </div>
</body>

</html>