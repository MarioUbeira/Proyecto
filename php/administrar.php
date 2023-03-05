<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
</head>

<body>


    <div class="tabla">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Cod_producto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descripcion_detallada</th>
                    <th scope="col">Destacado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $con = mysqli_connect("localhost", "root", "", "construccion");
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Error en la conexión a MySQL: " . mysqli_connect_error();
                }
                
                function selectCategorias($con){
                    $query = $con->query("SELECT * FROM productos");
                    return $query;
                }
                
                
                //$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
                //$query = $con->query("SELECT * FROM productos");
                //while ($valores = mysqli_fetch_array($query)) {
                    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
                //    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
                //    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
                //}
                
                $productos = selectCategorias($con);
                while ($valores = mysqli_fetch_array($productos)) {
                    echo "<tr>";
                    echo "<td>" . $valores["Cod_producto"] . "</td>";
                    echo "<td>" . $valores["Nombre"] . "</td>";
                    echo "<td>" . $valores["Descripcion"] . "</td>";
                    echo "<td>" . $valores["Precio"] . "</td>";
                    echo "<td>" . $valores["Stock"] . "</td>";
                    echo "<td>" . $valores["Categoria"] . "</td>";
                    echo "<td>" . $valores["Descripcion_detallada"] . "</td>";
                    if($valores["Destacado"] == 1){
                        echo "<td>SI</td>";
                    }else{
                        echo "<td>NO</td>";
                    }
                    echo "<td><button type='button' class='btn btn-info'>Editar</button></td>";
                    echo "<td><button type='button' class='btn btn-danger'>Borrar</button></td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>



</body>

</html>