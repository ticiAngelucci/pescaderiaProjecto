<?php 
include("conection.php");

if(isset($_POST['register'])){
    if(
        strlen($_POST['nombre'])>= 1 &&
        strlen($_POST['apellido'])>= 1 &&
        strlen($_POST['dni'])>= 1 &&
        strlen($_POST['password'])>= 1 &&
        strlen($_POST['email'])>= 1 &&
        strlen($_POST['id_localidad'])>= 1
        
        ){
            $nombre=trim($_POST['nombre']);
            $apellido=trim($_POST['apellido']);
            $dni=trim($_POST['dni']);
            $email=trim($_POST['email']);
            $password=trim($_POST['password']);
            $id_localidad=trim($_POST['id_localidad']);
            
            $consulta="INSERT INTO clientes(nombre,apellido,dni,email,password,id_localidad)
            VALUES('$nombre',' $apellido','$dni','$email','$password','$id_localidad')";            
            $resultado=mysqli_query($conexion,$consulta);   
            if ($resultado) {
                echo '<script>
                alert("Se han guardado la localidad");
                location.replace("../registro.php");
                </script>';
            }elseif (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['id_localidad'])) {
                echo '<script>
                alert("Complete todos los campos,porfavor");
                location.replace("../registro.php");
                </script>';
            }
            
            
            } else {
                echo '<script>
                alert("Hay un error a su registro,porfavor vuelva a intentar");
                location.replace("../registro.php");
                </script>';
            }
            
            
}

?>