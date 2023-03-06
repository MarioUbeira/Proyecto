<?php
include('sesion.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'>Añadido a favoritos</div>";


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
</style>


<body class="bg-light">
<?php include("header.php"); ?>
    <div class="container-fluid">
        <?php

        if (isset($_POST['anadir_fav'])) {
            header("Location: ../index.php ");
            if (!isset($_SESSION['favoritos'])) {
                $_SESSION['favoritos'] = array();
            }
            // Comprobar si el producto ya está en favoritos
            if (!in_array($_POST['id_producto_fav'], $_SESSION['favoritos'])) {
                array_push($_SESSION['favoritos'], $_POST['id_producto_fav']);
            }
        }


        if (isset($_SESSION['favoritos'])) {
            // Obtener detalles de los productos en favoritos
            $favoritos = array();
            foreach ($_SESSION['favoritos'] as $id_producto) {
                // Obtener información del producto de la base de datos
                $query = "SELECT Cod_producto, nombre, precio,descripcion FROM productos WHERE Cod_producto = :id_producto";
                $stmt = Conectar::conexion()->prepare($query);
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
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Imagen</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th></th></tr></thead>";
                    echo "<tbody>";

                    echo "<tr><td class='col-1'><img class='img-thumbnail' src='../imagenes/Productos/{$producto['Cod_producto']}.png'></td><td>{$producto['nombre']}</td><td>{$producto['descripcion']}</td><td>{$producto['precio']}€</td>";
                    echo "<td>";
                    // Formulario para eliminar el producto
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='eliminar_fav' value='{$producto['Cod_producto']}' />";
                    echo "<button type='submit' class='btn btn-danger'>🗑️</button>";
                    echo "";
                    echo "<form method='post' class='troll'><input type='hidden' name='id_producto' value='{$producto['Cod_producto']}'>
                    <input type='hidden' name='cantidad' value='1'>
                    <button class='btn btn-custom' name='anadir' type='submit'>🛒</button>
                  </form></form></form></td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No hay productos favoritos";
            }

        } else {
            echo "No hay productos favoritos";
        }
        // Eliminar producto de favoritos
        if (isset($_POST['eliminar_fav'])) {
            $id_producto = $_POST['eliminar_fav'];
            // Buscar el índice del producto en el array de favoritos
            $indice = array_search($id_producto, $_SESSION['favoritos']);

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