<?php
// Obtener los pedidos de la base de datos
use Config\Conectar;

include(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Conectar.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link href="../../../css/calendario.css" rel="stylesheet" type="text/css">
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Agregamos nuestros estilos personalizados -->
</head>
<?php
try {
    $pdo = Conectar::conexion('BTadmin');
} catch (PDOException $e) {
    echo 'Error al conectarse a la base de datos: ' . $e->getMessage();
    exit;
}
$sql = "SELECT pedidos.Cod_pedido,usuarios.Nombre,Fecha FROM pedidos INNER JOIN usuarios ON pedidos.Usuario = usuarios.id_usuario";
$statement = $pdo->prepare($sql);
$statement->execute();
$pedidos = $statement->fetchAll(PDO::FETCH_ASSOC);

// Crear un arreglo de eventos
$eventos = array();
foreach ($pedidos as $pedido) {
    $fecha = $pedido['Fecha'];
    $numero_pedido = $pedido['Cod_pedido'];
    $nombre_cliente = $pedido['Nombre'];
    $eventos[$fecha][] = array('numero_pedido' => $numero_pedido, 'nombre_cliente' => $nombre_cliente);
}
// Obtener el mes y año actual
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
// Generar el calendario
echo '<div class="row">';
echo '<div class="col-12">';
echo '<div class="module">';
echo '<div class="module-header d-flex justify-content-between align-items-center">';
echo '<h2>Calendario de pedidos - '.$month.'/'. $year.'</h2>';
echo '</div>';
echo '<div class="module-body">';
echo '<table class="calendar-table">';
echo '<tr>';
echo '<th class="calendar-header">Domingo</th>';
echo '<th class="calendar-header">Lunes</th>';
echo '<th class="calendar-header">Martes</th>';
echo '<th class="calendar-header">Miércoles</th>';
echo '<th class="calendar-header">Jueves</th>';
echo '<th class="calendar-header">Viernes</th>';
echo '<th class="calendar-header">Sábado</th>';
echo '</tr>';
// Botón para el mes anterior
$prev_month = ($month == 1) ? 12 : $month - 1;
$prev_year = ($month == 1) ? $year - 1 : $year;
echo '<button id="prevMonthBtn" class="butone" onclick="location.href=\'?month='.$prev_month.'&year='.$prev_year.'\'">Mes Anterior</button>';
// Botón para el mes siguiente
$next_month = ($month == 12) ? 1 : $month + 1;
$next_year = ($month == 12) ? $year + 1 : $year;
echo '<button id="nextMonthBtn" class="butone" onclick="location.href=\'?month='.$next_month.'&year='.$next_year.'\'">Mes Siguiente</button>';
$fecha_actual = strtotime("$year-$month-01");
$ultimo_dia_del_mes = strtotime('last day of this month', $fecha_actual);
$dia_actual = 1;

while ($fecha_actual <= $ultimo_dia_del_mes) {
    echo '<tr>';
    for ($i = 0; $i < 7; $i++) {
        $fecha_actual_str = date('Y-m-d', $fecha_actual);
        $tiene_pedido = isset($eventos[$fecha_actual_str]);
        $clase = $tiene_pedido ? 'has-pedidos' : 'no-pedidos';
        echo '<td data-date="' . $fecha_actual_str . '" class="calendar-cell ' . $clase . '">' . $dia_actual;
        if ($tiene_pedido) {
            echo '<div class="pedido-info">';
            foreach ($eventos[$fecha_actual_str] as $evento) {
                echo '<div class="pedido-info-item">';
                echo '<span class="cliente">Cliente: ' . $evento['nombre_cliente'] . '</span><br>';
                echo '<span class="pedido">Pedido: ' . $evento['numero_pedido'] . '</span>';
                echo '</div>';
            }
            echo '</div>';
        }

        echo '</td>';
        $fecha_actual = strtotime('+1 day', $fecha_actual);
        $dia_actual++;
    }
    echo '</tr>';
}

echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '<a href="../admin.php"><button class="btn btn-secondary">
Volver</button></a>';
?>
<script>
    const cells = document.querySelectorAll(".calendar-cell");
    cells.forEach(cell => {
        cell.addEventListener("click", () => {
            const pedidos = cell.querySelector(".pedido-info");
            if (pedidos) {
                pedidos.classList.add("visible");
                const backdrop = document.createElement("div");
                backdrop.classList.add("backdrop");
                document.body.appendChild(backdrop);
                backdrop.addEventListener("click", () => {
                    pedidos.classList.remove("visible");
                    document.body.removeChild(backdrop);
                })
            }
        })
    })
    // Obtener los botones de mes anterior y mes siguiente
    const prevMonthBtn = document.querySelector("#prevMonthBtn");
    const nextMonthBtn = document.querySelector("#nextMonthBtn");

    // Manejar el evento "click" de los botones
    prevMonthBtn.addEventListener("click", () => {
        // Obtener el mes y el año actual
        const currentMonth = parseInt("<?php echo $month ?>");
        const currentYear = parseInt("<?php echo $year ?>");

        // Obtener el mes y el año del mes anterior
        const prevMonth = currentMonth == 1 ? 12 : currentMonth - 1;
        const prevYear = currentMonth == 1 ? currentYear - 1 : currentYear;

        // Redirigir a la página del mes anterior
        window.location.href = `visualizar_pedidos.php?month=${prevMonth}&year=${prevYear}`;
    });

    nextMonthBtn.addEventListener("click", () => {
        // Obtener el mes y el año actual
        const currentMonth = parseInt("<?php echo $month ?>");
        const currentYear = parseInt("<?php echo $year ?>");

        // Obtener el mes y el año del mes siguiente
        const nextMonth = currentMonth == 12 ? 1 : currentMonth + 1;
        const nextYear = currentMonth == 12 ? currentYear + 1 : currentYear;

        // Redirigir a la página del mes siguiente
        window.location.href = `visualizar_pedidos.php?month=${nextMonth}&year=${nextYear}`;
    });
</script>
