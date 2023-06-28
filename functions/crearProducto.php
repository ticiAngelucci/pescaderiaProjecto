<?php include('conection.php'); 
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['id_categoria'];
$precio_por_gramo = $_POST['precio_por_gramo'];
$id_estado_producto = $_POST['id_estado_producto'];
$cantidad_disponible = $_POST['cantidad_disponible'];
$query="INSERT INTO productos(nombre,descripcion,id_categoria,precio_por_gramo,id_estado_producto,cantidad_disponible)
            VALUES('$nombre','$descripcion','$id_categoria','$precio_por_gramo','$id_estado_producto','$cantidad_disponible')";
$resultado=mysqli_query($conexion,$query); 
?>
<script>
alert("Agregado correctamente");
location.replace("../inicio.php");
</script>