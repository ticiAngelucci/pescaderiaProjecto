<?php
session_start();
include("conection.php");
$carrito_mio = $_SESSION['carrito'];
$total_general = $_POST['total_general'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$horario = $_POST['horario'];
$id_cliente = rand(0, 100);

$consultaPedidos = "INSERT INTO pedidos (id_cliente, total_pedido, fecha_entrega_pedido, hora_entrega_pedido, descripcion_pedido) VALUES ('$id_cliente', '$total_general', '$fecha', '$horario', '$descripcion')";
mysqli_query($conexion, $consultaPedidos);
$consultaTraerIdPedido = "SELECT id_pedido FROM pedidos where total_pedido='$total_general' AND hora_entrega_pedido='$horario' AND fecha_entrega_pedido='$fecha'";
$resultados = mysqli_query($conexion, $consultaTraerIdPedido);
if (mysqli_num_rows($resultados) !== 0) {
    $id_pedido;
    foreach ($resultados as $pedido) {
        $id_pedido = $pedido['id_pedido'];
    }
    $productos = $_POST['productos'];
    foreach ($productos as $producto) {
        
        /* $consultaInsertarCarrito = "INSERT INTO carritos_de_compras (id_pedido, id_producto, peso_del_producto) VALUES ('$id_pedido', '$id_producto', '$peso_del_producto')";
        mysqli_query($conexion, $consultaInsertarCarrito); */
    }
    if (isset($_SESSION['carrito'])) {
        // Destruir la variable $_SESSION['carrito']
        unset($_SESSION['carrito']);
    }
} else {
    echo "Error: no se encuentra ningún pedido con esas características";
}
?>
<script>
    alert("Se han guardado los cambios");
    location.replace("../inicio.php");
</script>
