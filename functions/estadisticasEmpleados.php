<?php
// Realiza la conexión a la base de datos.
include("conection.php");

// Obtener las fechas de inicio y fin del reporte
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$querySuma = "SELECT COUNT(*) AS total_pedidos
FROM pedidos
WHERE fecha_entrega_pedido BETWEEN '2023-06-06' AND '2023-06-30'";
// Consulta para obtener los pedidos realizados entre las fechas seleccionadas con el detalle completo de los productos
$query = "SELECT p.id_pedido, p.fecha_entrega_pedido, p.hora_entrega_pedido, e.nombre AS nombre_estado, c.nombre AS nombre_cliente, cp.id_producto, pr.nombre AS nombre_producto, cp.peso_del_producto 
FROM pedidos p
INNER JOIN estados_pedidos ep ON p.id_pedido = ep.id_pedido
INNER JOIN estados e ON ep.id_estado = e.id_estado
INNER JOIN clientes c ON p.id_cliente = c.id
INNER JOIN carritos_de_compras cp ON p.id_pedido = cp.id_pedido
INNER JOIN productos pr ON cp.id_producto = pr.id_producto
WHERE p.fecha_entrega_pedido BETWEEN '$fecha_inicio' AND '$fecha_fin'
ORDER BY p.fecha_entrega_pedido";

echo "queeery" . $query;
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
        echo '<tr><th>ID Pedido</th><th>Fecha Entrega</th><th>Hora Entrega</th><th>Estado Actual</th><th>Cliente</th><th>ID Producto</th><th>Nombre Producto</th><th>Peso del Producto</th><th>Demora entre Estados</th></tr>';

        $fecha_anterior = null; // Variable para almacenar la fecha del estado anterior

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_pedido'] . '</td>';
            echo '<td>' . $row['fecha_entrega_pedido'] . '</td>';
            echo '<td>' . $row['hora_entrega_pedido'] . '</td>';
            echo '<td>' . $row['nombre_estado'] . '</td>';
            echo '<td>' . $row['nombre_cliente'] . '</td>';
            echo '<td>' . $row['id_producto'] . '</td>';
            echo '<td>' . $row['nombre_producto'] . '</td>';
            echo '<td>' . $row['peso_del_producto'] . '</td>';

            // Calcula la demora entre estados si hay una fecha anterior registrada
            if ($fecha_anterior !== null) {
                $fecha_actual = strtotime($row['fecha_entrega_pedido']);
                $fecha_anterior = strtotime($fecha_anterior);
                $diferencia = ($fecha_actual - $fecha_anterior) / (60 * 60 * 24); // Diferencia en días
                echo '<td>' . $diferencia . ' días</td>';
            } else {
                echo '<td> - </td>';
            }

            echo '</tr>';
            $fecha_anterior = $row['fecha_entrega_pedido'];
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
