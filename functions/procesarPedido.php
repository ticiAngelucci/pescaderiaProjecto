<?php 
session_start();
include("conection.php");
$carrito_mio=$_SESSION['carrito'];
$total_general = $_POST['total_general'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$horario = $_POST['horario'];
$id_cliente=rand(0, 100);

$consultaPedidos = "INSERT INTO pedidos (id_cliente, total_pedido, fecha_entrega_pedido, hora_entrega_pedido, descripcion_pedido) VALUES ('$id_cliente', '$total_general', '$fecha', '$horario', '$descripcion')";
mysqli_query($conexion, $consultaPedidos);
if (isset($_SESSION['carrito'])) {
    // Destruir la variable $_SESSION['carrito']
    unset($_SESSION['carrito']);
}
  
    
?>
<script>
alert("Se han guardado los cambios");
location.replace("../inicio.php");
</script>