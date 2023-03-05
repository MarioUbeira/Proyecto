<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="contenedor">
            <form id="formulario">
                <div>
                    <input type="text" class="form-control" id="floatingInput" name="nombre" placeholder="#">
                    <label for="floatingInput">Nombre</label>
                </div>
                <div>
                    <input type="text" class="form-control" id="floatingInput" name="usuario" placeholder="#">
                    <label for="floatingInput">Usuario</label>
                </div>
                <div>
                    <input type="email" class="form-control" id="floatingInput" name="usuario" placeholder="#">
                    <label for="floatingInput">Email</label>
                </div>
                <input id="archivo" type="file" name="foto"/>
                <input type="submit" value="Enviar informacion">

            </form>
        </div>
        
        <?php
        
        $con = mysqli_connect("localhost", "root", "", "construccion");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Error en la conexión a MySQL: " . mysqli_connect_error();
        }
        
        function selectCategorias($cat, $con){
            $query = $con->query("SELECT * FROM productos WHERE Categoria='" .$cat ."'");
            return $query;
        }
        
        
        //$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
        //$query = $con->query("SELECT * FROM productos");
        //while ($valores = mysqli_fetch_array($query)) {
            //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
        //    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
        //    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
        //}
        
        $productos = selectCategorias(9, $con);
        while ($valores = mysqli_fetch_array($productos)) {
            //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
            echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
            echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
        }
        
        ?>
    </body>
</html>
