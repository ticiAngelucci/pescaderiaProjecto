<?php
include("conection.php");
include("config.php");
$nombre = $_POST['nombre'];
$id = $_POST['id_producto'];

$consulta_insercion = "INSERT INTO estado_producto (estado_producto) VALUES ('$nombre')";
mysqli_query($conexion, $consulta_insercion);
$token = hash_hmac('sha1', $id, KEY_TOKEN);

?>
<script>
    var id = "<?php echo $id; ?>";
    var token = "<?php echo $token; ?>";
    var url;
    if (id !== null) {
        url = "../editarProducto.php?id_producto=" + id + "&token=" + token;
    } else {
        url = "../crearProducto.php";
    }
    alert("Se han guardado el nuevo estado de producto");
    location.replace(url);
</script>