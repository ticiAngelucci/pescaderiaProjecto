<?php
include('conection.php');

$idEstadoSiguiente = $_GET['idEstadoSiguiente'];
$idPedido = $_GET['idPedido'];
echo "idEstadoSiguiente: " . $idEstadoSiguiente . "<br>";
echo "idPedido: " . $idPedido . "<br>";
$idEstadoSiguiente=$idEstadoSiguiente+1;
echo "idEstadoSiguiente suma: " . $idEstadoSiguiente . "<br>";
// Preparar la consulta utilizando una sentencia preparada
$consultaEstadoPedido = "INSERT INTO estados_pedidos (id_estado, id_pedido, hora_fecha_now) VALUES (?, ?, NOW())";
$statement = mysqli_prepare($conexion, $consultaEstadoPedido);
mysqli_stmt_bind_param($statement, "ii", $idEstadoSiguiente, $idPedido);
mysqli_stmt_execute($statement);

header("Location: ../estadoPedidos.php");
exit();
?>
