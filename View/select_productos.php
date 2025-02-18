<?php
use Config\Conectar;

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');


/*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */

$con = Conectar::conexion('busuario');
$cat = $_POST['categoria'];
switch ($cat) {
    case "Tejados Y Cubiertas":
        $cat = 1;
        break;
    case "Cementos Y Morteros":
        $cat = 2;
        break;
    case "Yesos Y Escayolas":
        $cat = 3;
        break;
    case "Arenas y Gravas":
        $cat = 4;
        break;
    case "Cercados y Ocultación":
        $cat = 5;
        break;
    case "Madera":
        $cat = 6;
        break;
    case "Hormigoneras, carretillas...":
        $cat = 7;
        break;
    case "Aislamientos":
        $cat = 8;
        break;
    case "Elementos de construcción":
        $cat = 9;
        break;
}
$ins = "SELECT Cod_producto,Nombre,Precio,Stock FROM productos WHERE Categoria='$cat'";
$resul = $con->query($ins);
$texto = '';
$categorias = array(
    "1" => "Tejados Y Cubiertas",
    "2" => "Cementos Y Morteros",
    "3" => "Yesos Y Escayolas",
    "4" => "Arenas y Gravas",
    "5" => "Cercados y Ocultación",
    "6" => "Madera",
    "7" => "Hormigoneras, carretillas...",
    "8" => "Aislamientos",
    "9" => "Elementos de construcción"
);
$valor_categoria = $cat;
$nombre_categoria = $categorias[$valor_categoria];
$texto .= "<div class='titCat'>$nombre_categoria</div>";
$texto .= "<div class='textCat'>Descubre nuestra amplia gama de $nombre_categoria, diseñados para satisfacer las necesidades de cualquier proyecto de construcción.</div>";
$texto .= "<div class='productos'>";
foreach ($resul as $row) {
    $cod = $row['Cod_producto'];
    $stock = $row['Stock'];
    $precio_formateado = number_format($row["Precio"], 2);
    $texto .= "<div class='producto'>";
    $texto .= "<img src='../imagenes/Productos/{$row['Cod_producto']}.png'></img>";
    $texto .= "<label>" . $row["Nombre"] . "</label>";
    $texto .= "<label>" . $precio_formateado . "€/Ud</label>";
    $texto .= "<div class='button'>
    <form class='fav' method='post'>
          <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' type='number' min = '1' max='{$row['Stock']}' value = '1'>
            </form>
    </div>";
    $texto .= "</div>";
}
$texto .= "</div>";
$output = $texto;
echo $output;