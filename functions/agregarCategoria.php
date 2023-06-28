<?php 
include("conection.php");
$nombre = $_POST['nombre'];

$consulta_insercion = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
mysqli_query($conexion, $consulta_insercion);

    
?>
<script>
alert("Se han guardado la categoria");
location.replace("../editarProducto.php");
</script>