<?php 
include("conection.php");
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['id_categoria'];
$precio_por_gramo = $_POST['precio_por_gramo'];
$id_estado_producto = $_POST['id_estado_producto'];
$cantidad_disponible = $_POST['cantidad_disponible'];
$consulta="UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', id_categoria = '$id_categoria', precio_por_gramo = '$precio_por_gramo', id_estado_producto = '$id_estado_producto', cantidad_disponible = '$cantidad_disponible'
             WHERE id_producto = '$id_producto'";            
$resultado=mysqli_query($conexion,$consulta) or die ('Error: '. mysqli_error($con));
?>
<script>
    alert("Editado correctamente");
    location.replace("../inicio.php");
</script>