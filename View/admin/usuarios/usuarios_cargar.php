<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$db = Conectar::conexion('BTadmin');
$sql = "SELECT * FROM usuarios";
$stmt = $db->prepare($sql);
$stmt->execute();
$contador = 1;
$texto = "";
while ($valores = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $texto .= "<tr id='fila" . $contador . "'>";
    $texto .= "<td readonly>" . $valores["id_usuario"] . "</td>";
    $texto .= "<td>" . $valores["Nombre"] . "</td>";
    $texto .= "<td>" . $valores["Apellidos"] . "</td>";
    $texto .= "<td>" . $valores["Correo"] . "</td>";
    $texto .= "<td>" . $valores["Telefono"] . "</td>";
    $texto .= "<td>" . $valores["id_rol"] . "</td>";
    $texto .= "<td><button type='button' id='btn' class='btn btn-info'>Editar</button></td>";
    $texto .= "<td><button type='button' class='btn btn-danger'>Borrar</button></td>";
    $texto .= "</tr>";
    $contador++;
}
$output = $texto;
echo $output;
?>