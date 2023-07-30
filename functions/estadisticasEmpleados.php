<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pedidos</title>

    <!-- Estilos para el modal -->
    <style>
    /* Estilo para el modal */
    #myModal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    #modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* Estilo para la tabla de detalles */
    #detalles-table {
        width: 100%;
    }
    </style>
</head>

<body>
    <?php
    // Realiza la conexión a la base de datos.
    include("conection.php");

    // Función para calcular la diferencia en días y horas entre dos fechas
    function calcularDiferenciaFechas($fecha1, $fecha2)
    {
        // Convertir las fechas en objetos DateTime
        $dateTime1 = new DateTime($fecha1);
        $dateTime2 = new DateTime($fecha2);
        // Calcular la diferencia entre las fechas
        $interval = $dateTime1->diff($dateTime2);
        // Obtener la diferencia en días y horas
        $diferencia_dias = $interval->days;
        $diferencia_horas = $interval->h;
        echo "diferencia dia:" . $diferencia_dias;
        echo "diferencia hora:" . $diferencia_horas;
        return array('dias' => $diferencia_dias, 'horas' => $diferencia_horas);
    }

    // Obtener las fechas de inicio y fin del reporte
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $querySuma = "SELECT COUNT(*) AS total_pedidos
    FROM pedidos
    WHERE fecha_entrega_pedido BETWEEN '$fecha_inicio' AND '$fecha_fin'";

    // Consulta para obtener los pedidos realizados entre las fechas seleccionadas con el detalle completo de los productos
    $query = "SELECT p.id_pedido, p.fecha_entrega_pedido, p.hora_entrega_pedido, e.nombre AS nombre_estado, c.nombre AS nombre_cliente, ep.hora_fecha_now
    FROM pedidos p
    INNER JOIN estados_pedidos ep ON p.id_pedido = ep.id_pedido
    INNER JOIN estados e ON ep.id_estado = e.id_estado
    INNER JOIN clientes c ON p.id_cliente = c.id
    WHERE p.fecha_entrega_pedido BETWEEN '$fecha_inicio' AND '$fecha_fin'
    ORDER BY p.id_pedido, ep.hora_fecha_now"; // Ordenar por ID de pedido y hora

    $result = mysqli_query($conexion, $query);
    $resultSuma = mysqli_query($conexion, $querySuma);
    echo "Fecha de inicio: " . $fecha_inicio . "<br>";
    echo "Fecha de fin: " . $fecha_fin . "<br>";
    if ($resultSuma && mysqli_num_rows($resultSuma) > 0) {

        $rowSuma = mysqli_fetch_assoc($resultSuma);
        $totalPedidos = $rowSuma['total_pedidos'];

        echo "Total de pedidos entre las fechas seleccionadas: " . $totalPedidos . "<br>";
    }
    if ($result) {
        echo "Llegué aquí 1: Consulta exitosa<br>";
        if (mysqli_num_rows($result) > 0) {
            echo "Llegué aquí 2: Se encontraron pedidos<br>";
            // Mostrar el reporte en una tabla
            echo '<table>';
            echo '<tr><th>ID Pedido</th><th>Fecha Entrega</th><th>Hora Entrega</th><th>Estado Actual</th><th>Cliente</th><th>Fecha Estado</th><th>Hora Estado</th><th>Diferencia en Días</th><th>Diferencia en Horas</th><th>Ver más</th></tr>';

            $estado_anterior = null; // Variable para almacenar el estado anterior del pedido
            $hora_anterior = null; // Variable para almacenar la hora del estado anterior

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_pedido'] . '</td>';
                echo '<td>' . $row['fecha_entrega_pedido'] . '</td>';
                echo '<td>' . $row['hora_entrega_pedido'] . '</td>';
                echo '<td>' . $row['nombre_estado'] . '</td>';
                echo '<td>' . $row['nombre_cliente'] . '</td>';

                // Mostrar fecha y hora del estado actual en columnas separadas
                $hora_fecha_estado = new DateTime($row['hora_fecha_now']);
                echo '<td>' . $hora_fecha_estado->format('Y-m-d') . '</td>';
                echo '<td>' . $hora_fecha_estado->format('H:i:s') . '</td>';

                // Verificar si es el primer estado o no
                if ($estado_anterior !== null && $hora_anterior !== null) {
                    $diferencia = calcularDiferenciaFechas($hora_anterior, $row['hora_fecha_now']);
                    $diferencia_dias = $diferencia['dias'];
                    $diferencia_horas = $diferencia['horas'];
                } else {
                    // Si es el primer estado, establecer diferencias en 0
                    $diferencia_dias = 0;
                    $diferencia_horas = 0;
                }

                echo '<td>' . $diferencia_dias . '</td>';
                echo '<td>' . $diferencia_horas . '</td>';

                // Actualizar el estado y hora anterior para el siguiente cálculo
                $estado_anterior = $row['nombre_estado'];
                $hora_anterior = $row['hora_fecha_now'];

                // Botón "Ver más" que abre el modal con los detalles del pedido
                echo '<td><button onclick="verDetalles(' . $row['id_pedido'] . ')">Ver más</button></td>';

                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<script>';
            echo 'alert("No se encontraron pedidos entre las fechas especificadas.");';
            /* echo 'window.location.replace("../estadisticasEmpleados.php");'; */
            echo '</script>';
        }
    } else {
        echo "Llegué aquí 3: Error al ejecutar la consulta: " . mysqli_error($conexion);
    }
    ?>

    <!-- Código JavaScript para el modal -->
    <script>
    function verDetalles(idPedido) {
        // Aquí puedes utilizar JavaScript o librerías como jQuery para abrir el modal y cargar los detalles del pedido utilizando AJAX.
        // Por simplicidad, te muestro una alerta con el ID del pedido seleccionado.
        alert('Ver detalles del pedido con ID: ' + idPedido);
        /* <?php
            $queryDetalles = "SELECT carrito_compras.id_producto, carrito_compras.peso_del_producto, carrito_compras.id_pedido,
        productos.nombre, productos.precio_por_gramo
        FROM carrito_compras
        INNER JOIN productos ON carrito_compras.id_producto = productos.id_producto
        WHERE id_pedido = $idPedido ";

            $resultDetalles = mysqli_query($conexion, $queryDetalles);
            ?> */
    }
    </script>
</body>

</html>