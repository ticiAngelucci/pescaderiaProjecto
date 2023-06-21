<?php
// Función para obtener los detalles de un pedido por su ID
function getPedido($idPedido) {
    global $conexion;

    // Consultar la base de datos para obtener los detalles del pedido con el ID proporcionado
    $sql = "SELECT * FROM pedidos WHERE id_pedido = $idPedido";
    $result = $conexion->query($sql);

    // Verificar si se encontró el pedido en la base de datos
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


function getEstadoPedido($idPedido) {
    global $conexion;

    $sql = "SELECT estado FROM estado_pedidos WHERE id_pedido = $idPedido";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['estado'];
    } else {
        return false;
    }
}