<?php 
include("conection.php");
$nombre = $_POST['nombre'];

$consulta_insercion = "INSERT INTO estado_producto (estado_producto) VALUES ('$nombre')";
mysqli_query($conexion, $consulta_insercion);

    
?>
<script>
alert("Se han guardado el nuevo estado de producto");
location.replace("../editarProducto.php");
</script>