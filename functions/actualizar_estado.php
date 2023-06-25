<?php
include('conection.php');
$idEstadoSiguiente = $_GET['idEstadoSiguiente'];
$idPedido = $_GET['idPedido'];
$consultaEstadoPedido = "INSERT INTO estados_pedidos (id_estado, id_pedido, hora_fecha_now) VALUES ('$idEstadoSiguiente','$idPedido', NOW())";
mysqli_query($conexion, $consultaEstadoPedido);
header("Location:../estadoPedidos.php");
?>
