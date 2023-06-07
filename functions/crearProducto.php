
<?php include('conection.php'); 
$nombre = utf8_decode($_POST['nombre']);
$descripcion = utf8_decode($_POST['descripcion']);
$id_categoria = utf8_decode($_POST['id_categoria']);
$precio_por_gramo = utf8_decode($_POST['precio_por_gramo']);
$id_estado_producto = utf8_decode($_POST['id_estado_producto']);
$cantidad_disponible = utf8_decode($_POST['cantidad_disponible']);
$query="INSERT INTO productos(nombre,descripcion,id_categoria,precio_por_gramo,id_estado_producto,cantidad_disponible)
            VALUES('$nombre','$descripcion','$id_categoria','$precio_por_gramo','$id_estado_producto','$cantidad_disponible')";
$resultado=mysqli_query($conexion,$query); 
?>
<script>
    alert("Agregado correctamente");
    location.replace("../inicio.php");
</script>
