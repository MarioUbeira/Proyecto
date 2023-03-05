<?php
include('../../../Config/Conectar.php');
$conn = Conectar::conexion();

// Consulta SELECT para obtener el último valor autoincrementable
$query = "SELECT Cod_producto FROM productos ORDER BY Cod_producto DESC LIMIT 1";
$stmt = $conn->query($query);

// Obtener el último ID generado
$last_id = $stmt->fetchColumn();


if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
	$nombre = $_FILES['file']['name'];
	$tipo = $_FILES['file']['type'];
	$tamaño = $_FILES['file']['size'];
	$tmp = $_FILES['file']['tmp_name'];

	$fileExt = explode('.', $nombre);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'jfif');

	if (in_array($fileActualExt, $allowed)) {
		if ($tamaño < 1000000000) {
			$fileNameNew =$last_id . ".png"; // Cambiar el nombre del archivo final
			$fileDestination = '../../../imagenes/Productos';
			move_uploaded_file($tmp, "$fileDestination/$fileNameNew");
			echo 'Subido';
		} else {
			echo "Archivo demasiado grande";
		}
	} else {
		echo "Tipo no compatible";
	}
}

?>