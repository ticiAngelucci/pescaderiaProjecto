<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pedidos</title>
    <link rel="shortcut icon" href="../assets/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    include("conection.php");
    include("config.php");

    // Función para calcular la diferencia en días, horas, minutos y segundos entre dos fechas
    function calcularDiferenciaFechas($fecha1, $fecha2)
    {
        // Convertir las fechas en objetos DateTime
        $dateTime1 = new DateTime($fecha1);
        $dateTime2 = new DateTime($fecha2);
        // Calcular la diferencia entre las fechas
        $interval = $dateTime1->diff($dateTime2);
        // Obtener la diferencia en días, horas, minutos y segundos
        $diferencia_dias = $interval->days;
        $diferencia_horas = $interval->h;
        $diferencia_minutos = $interval->i;
        $diferencia_segundos = $interval->s;
        return array('dias' => $diferencia_dias, 'horas' => $diferencia_horas, 'minutos' => $diferencia_minutos, 'segundos' => $diferencia_segundos);
    }    

    // Obtener las fechas de inicio y fin del reporte
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $querySuma = "SELECT COUNT(*) AS total_pedidos
    FROM pedidos
    WHERE fecha_entrega_pedido BETWEEN '$fecha_inicio' AND '$fecha_fin'";

    // Consulta para obtener los pedidos realizados entre las fechas seleccionadas con el detalle completo de los productos
    $query = "SELECT p.id_pedido, p.fecha_entrega_pedido, p.hora_entrega_pedido, e.nombre AS nombre_estado, c.nombre AS nombre_cliente, ep.hora_fecha_now, ep.id_estado
    FROM pedidos p
    INNER JOIN estados_pedidos ep ON p.id_pedido = ep.id_pedido
    INNER JOIN estados e ON ep.id_estado = e.id_estado
    INNER JOIN clientes c ON p.id_cliente = c.id
    WHERE p.fecha_entrega_pedido BETWEEN '$fecha_inicio' AND '$fecha_fin'
    ORDER BY p.id_pedido, ep.hora_fecha_now"; // Ordenar por ID de pedido y hora

    $result = mysqli_query($conexion, $query);
    $resultSuma = mysqli_query($conexion, $querySuma);
    echo '<div class="container mt-4">';
    echo '<h1 class="mb-4">Reporte de Pedidos</h1>';
    echo '<div class="table-responsive">';
    if ($resultSuma && mysqli_num_rows($resultSuma) > 0) {

        $rowSuma = mysqli_fetch_assoc($resultSuma);
        $totalPedidos = $rowSuma['total_pedidos'];

        echo '<p>Fecha de inicio: ' . $fecha_inicio . '</p>';
        echo '<p>Fecha de fin: ' . $fecha_fin . '</p>';
        echo '<p>Total de pedidos entre las fechas seleccionadas: ' . $totalPedidos . '</p>';
    }

    if ($result) {
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID Pedido</th>';
        echo '<th>Fecha Entrega</th>';
        echo '<th>Hora Entrega</th>';
        echo '<th>Estado Actual</th>';
        echo '<th>Cliente</th>';
        echo '<th>Fecha Estado</th>';
        echo '<th>Hora Estado</th>';
        echo '<th>Diferencia en Días</th>';
        echo '<th>Diferencia en Horas</th>';
        echo '<th>Ver más</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $estado_anterior = null; // Variable para almacenar el estado anterior del pedido
        $hora_anterior = null; // Variable para almacenar la hora del estado anterior
        $diferencia_dias = 0;
        $diferencia_horas = 0;
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_pedido'] . '</td>';
            echo '<td>' . $row['fecha_entrega_pedido'] . '</td>';
            echo '<td>' . $row['hora_entrega_pedido'] . '</td>';

            // Verificar si el estado es "Se recibió el pedido" y establecer las diferencias en 0
            if (isset($row['nombre_estado']) && $row['nombre_estado'] === 'Se recibio el pedido') {
                $diferencia_dias = 0;
                $diferencia_horas = 0;
            } else {
                // Calcular la diferencia solo si hay un estado anterior y el estado no es "Se recibió el pedido"
                if ($estado_anterior !== null && $hora_anterior !== null && $row['id_estado'] !== 1) {
                    // Usar la hora del estado anterior como fecha de inicio para calcular la diferencia
                    $diferencia = calcularDiferenciaFechas($hora_anterior, $row['hora_fecha_now']);
                    $diferencia_dias = $diferencia['dias']; // Diferencia en días
                    $diferencia_horas = $diferencia['horas']; // Diferencia en horas
                } else {
                    // Si no hay un estado anterior o el estado es "Se recibió el pedido", la diferencia es 0
                    $diferencia_dias = 0;
                    $diferencia_horas = 0;
                }
            }

            // Check if the difference is less than 1 hour or 1 day
            $mensaje_dias = ($diferencia_dias < 1) ? "No llegó al día" : $diferencia_dias;
            $mensaje_horas = ($diferencia_horas < 1) ? "No llega a la hora" : $diferencia_horas;

            // Resaltar el texto "Se recibió el pedido" en rojo solo si el estado no es "Se recibió el pedido"
            if ($row['nombre_estado'] === "Se recibio el pedido") {
                echo '<td style="color:red;">' . $row['nombre_estado'] . '</td>';
            } else {
                echo '<td>' . $row['nombre_estado'] . '</td>';
            }

            echo '<td>' . $row['nombre_cliente'] . '</td>';

            // Mostrar fecha y hora del estado actual en columnas separadas
            $hora_fecha_estado = new DateTime($row['hora_fecha_now']);
            echo '<td>' . $hora_fecha_estado->format('Y-m-d') . '</td>';
            echo '<td>' . $hora_fecha_estado->format('H:i:s') . '</td>';

            echo '<td>' . ($row['nombre_estado'] === "Se recibio el pedido" ? 0 : $mensaje_dias) . '</td>';
            echo '<td>' . $mensaje_horas . '</td>';

            // Actualizar el estado y hora anterior para el siguiente cálculo
            $estado_anterior = $row['nombre_estado'];
            $hora_anterior = $row['hora_fecha_now'];

            // Botón "Ver más" que redirige a la página de descripción del pedido con su respectivo id_pedido y token
            $id_pedido = $row['id_pedido'];
            $token = hash_hmac('sha1', $id_pedido, KEY_TOKEN);
            echo '<td><a href="../descripcionPedido.php?id_pedido=' . $id_pedido . '&token=' . $token . '" class="btn btn-primary btn-sm btn-block">Ver más</a></td>';

            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; 
        echo '</div>'; 
    } else {
        echo '<p class="alert alert-danger">No se encontraron pedidos entre las fechas especificadas.</p>';
    }
    echo '<div style="padding-bottom:20px;" class="container">';
    echo '<a href="../inicio.php" class="btn btn-secondary mt-3">Regresar a Home</a>';
    echo '</div>';
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
