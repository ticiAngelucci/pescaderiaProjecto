<?php 
include("conection.php");
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$id_localidad = $_POST['id_localidad'];
$rol_usuario_editar = $_POST['rolUsuario'];
$tipo_usuario = $_POST['tipo_usuario'];
if($tipo_usuario=='clientes'){
    if($tipo_usuario==$rol_usuario_editar){
        $consulta="UPDATE $tipo_usuario SET nombre='$nombre', apellido='$apellido', email = '$email', password = '$password', id_localidad = '$id_localidad'
        WHERE id = '$id'";
        mysqli_query($conexion, $consulta);
    }elseif($tipo_usuario!=$rol_usuario_editar){
        $consulta_insercion = "INSERT INTO $rol_usuario_editar (nombre, apellido, email, password, dni) VALUES ('$nombre', '$apellido', '$email', '$password', '$dni')";
        mysqli_query($conexion, $consulta_insercion);
  
        $consulta_borrado = "DELETE FROM clientes WHERE id = '$id'";
        mysqli_query($conexion, $consulta_borrado);
    }else{
        echo "error en actualizar";
    }
}else{
    if($tipo_usuario==$rol_usuario_editar){
        $consulta="UPDATE $tipo_usuario SET  nombre='$nombre', apellido='$apellido', email = '$email', password = '$password'
        WHERE id = '$id'";
        mysqli_query($conexion, $consulta);
    }elseif($tipo_usuario!=$rol_usuario_editar){
        $consulta_insercion = "INSERT INTO $rol_usuario_editar (nombre, apellido, email, password, dni,id_localidad) VALUES ('$nombre', '$apellido', '$email', '$password', '$dni', '$id_localidad')";
        mysqli_query($conexion, $consulta_insercion);
  
        $consulta_borrado = "DELETE FROM empleados WHERE id = '$id'";
        mysqli_query($conexion, $consulta_borrado);
    }else{
        echo "error en actualizar";
    }
}
    
?>
<script>
alert("Se han guardado los cambios");
location.replace("../listadoUsuarios.php");
</script>