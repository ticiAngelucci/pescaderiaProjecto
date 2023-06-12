<?php 
include("conection.php");
$nombre = $_POST['nombre'];

$consulta_insercion = "INSERT INTO localidades (localidad) VALUES ('$nombre')";
mysqli_query($conexion, $consulta_insercion);

    
?>
<script>
alert("Se han guardado la localidad");
location.replace("../registro.php");
</script>