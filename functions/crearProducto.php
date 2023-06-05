
<?php include('conection.php'); 
$nombre = utf8_decode($_POST['nombre']);
$descripcion = utf8_decode($_POST['descripcion']);
$id_categoria = utf8_decode($_POST['id_categoria']);
$precio_por_gramo = utf8_decode($_POST['precio_por_gramo']);
$id_estado_producto = utf8_decode($_POST['id_estado_producto']);
$cantidad_disponible = utf8_decode($_POST['cantidad_disponible']);
$db_table_name= 'productos';
$insert_value = 'INSERT INTO `' . $db . '`.`'.$db_table_name.'` (`nombre` , `descripcion` , `id_categoria`, `precio_por_gramo`,`id_estado_producto`,`cantidad_disponible`) VALUES("' . $nombre . '", "' . $descripcion . '","' . $id_categoria . '", "' . $precio_por_gramo . '","' . $id_estado_producto . '", "' . $cantidad_disponible . '")';
 
mysqli__select_db($db, $conexion);
$retry_value = mysqli__query($insert_value, $conexion);
 
if (!$retry_value) {
   die('Error: ' . mysqli__error());
}
 
 
mysqli__close($conexion);
 
?>