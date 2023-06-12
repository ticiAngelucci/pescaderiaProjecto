<?php 
include("conection.php");
$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$id_localidad = $_POST['id_localidad'];
$tipo_usuario = $_POST['tipo_usuario'];
$consulta="UPDATE $tipo_usuario SET  email = '$email', password = '$password', id_localidad = '$id_localidad'
             WHERE id = '$id'";            
$resultado=mysqli_query($conexion,$consulta) or die ('Error: '. mysqli_error($conexion));
?>
<script>
    alert("Se han guardado los cambios");
    location.replace("../listadoUsuarios.php");
</script>