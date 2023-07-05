<?php 
include("conection.php");
include("config.php");
$nombre = $_POST['nombre'];
$id = $_POST['id_producto'];

$consulta_insercion = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
mysqli_query($conexion, $consulta_insercion);
$token=hash_hmac('sha1',$id,KEY_TOKEN);
    
?>
<script>
var id = "<?php echo $id; ?>";
var token = "<?php echo $token; ?>";
var url = "../editarProducto.php?id_producto=" + id + "&token=" + token;
alert("Se han guardado la categoria");
location.replace(url);
</script>