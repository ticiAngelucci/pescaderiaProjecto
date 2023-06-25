<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include('config.php');
include('conection.php');

if (isset($_SESSION['id_usuario'])) {
    $id_cliente = $_SESSION['id_usuario'];
} else {
    echo "Error: No se encontró el ID del usuario en la sesión.";
    exit;
}
if (isset($_SESSION['carrito'])) {
    $carrito_mio = $_SESSION['carrito'];
} else {
    echo "Hay un error con el carrito";
}
$total_general = $_POST['total_general'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$horario = $_POST['horario'];

$consultaPedidos = "INSERT INTO pedidos (id_cliente, total_pedido, fecha_entrega_pedido,hora_fecha_now, hora_entrega_pedido, descripcion_pedido) VALUES ('$id_cliente', '$total_general', '$fecha',NOW(), '$horario', '$descripcion')";
mysqli_query($conexion, $consultaPedidos);

$consultaTraerIdPedido = "SELECT id_pedido FROM pedidos where total_pedido='$total_general' AND hora_entrega_pedido='$horario' AND fecha_entrega_pedido='$fecha'";
$resultados = mysqli_query($conexion, $consultaTraerIdPedido);

if (mysqli_num_rows($resultados) !== 0) {
    $id_pedido = mysqli_fetch_assoc($resultados)['id_pedido'];
    $consultaEstadoPedido = "INSERT INTO estados_pedidos (id_estado, id_pedido, hora_fecha_now) VALUES (1, '$id_pedido', NOW())";
    mysqli_query($conexion, $consultaEstadoPedido);
    foreach ($carrito_mio as $i => $producto) {
        $id_producto = $_POST['id_producto_' . $i];
        $nombre = $_POST['nombre_' . $i];
        $precio_por_gramo = $_POST['precio_por_gramo_' . $i];
        $cantidad_disponible = $_POST['cantidad_disponible_' . $i];
        $cantidad_por_gramos_multiplicado = $_POST['precio_por_gramos_multiplicado' . $i];
        $precio_total = $_POST['precio_total_' . $i];
        $consultaRestar = "SELECT * FROM productos where id_producto='$id_producto'";
        $resultadosRestar = mysqli_query($conexion, $consultaRestar);
        foreach($resultadosRestar as $aRestar){
            $nuevaCantidad = $aRestar['cantidad_disponible']-$cantidad_por_gramos_multiplicado;
            $consultaActualizarRestar = "UPDATE productos SET cantidad_disponible = $nuevaCantidad WHERE id_producto = $id_producto";
        }
        $consultaCarrito = "INSERT INTO carritos_de_compras (id_pedido, id_producto, peso_del_producto) VALUES ('$id_pedido', '$id_producto', '$cantidad_por_gramos_multiplicado')";
        mysqli_query($conexion, $consultaCarrito);
    }
    unset($_SESSION['carrito']);
} else {
    echo "Error: No se encontró ningún pedido con esas características.";
}
?>
<script>
    alert("Se han guardado los cambios");
    location.replace("../inicio.php");
</script>