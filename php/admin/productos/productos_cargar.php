<?php
include('../../../Config/Conectar.php');

$db = Conectar::conexion();
$sql = "SELECT Cod_producto,Nombre,Descripcion,Precio,Stock,Categoria,Descripcion_detallada,Destacado FROM productos";
$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta SQL.");
}

$stmt->execute();
$contador = 1;
$texto = "";
while ($valores = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $texto .= "<tr id='fila" . $contador ."'>";
    $texto .= "<td readonly>" . $valores["Cod_producto"] . "</td>";
    $texto .= "<td>" . $valores["Nombre"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion"] . "</td>";
    $texto .= "<td>" . $valores["Precio"] . "</td>";
    $texto .= "<td>" . $valores["Stock"] . "</td>";
    $texto .= "<td>" . $valores["Categoria"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion_detallada"] . "</td>";
    if($valores["Destacado"] == 1){
        $texto .= "<td>SI</td>";
    }else{
        $texto .= "<td>NO</td>";
    }
    $texto .= "<td><button type='button' id='btn' class='btn btn-info'>Editar</button></td>";
    $texto .= "<td><button type='button' class='btn btn-danger'>Borrar</button></td>";
    $texto .= "</tr>";
    $contador++;
}
$output =$texto;
echo $output;
