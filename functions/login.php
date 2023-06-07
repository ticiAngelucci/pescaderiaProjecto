<?php 
include("functions/conection.php");


if(!empty($_POST["btningresar"])){
    if(empty($_POST["email"]) and empty($_POST["password"])){
        echo '<div class="alert alert-danger">Campos vacios</div>';
    }else{
        $email=$_POST["email"];
        $password=$_POST["password"];
        $consulta=$conexion->query("select * from clientes where email='$email' and password='$password'");
        if($datos=$consulta->fetch_object()){
            header("location:quienesSomos.php");
        }else{
            echo '<div class="alert alert-danger">El usuario o Contraseña no existen</div>';
        }
    }


}

?>