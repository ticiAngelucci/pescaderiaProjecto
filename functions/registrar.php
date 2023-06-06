<?php 
include("functions/conection.php");

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
            
            $consulta="INSERT INTO clientes(nombre,apellido,dni,password,email,id_localidad)
            VALUES('$nombre',' $apellido','$dni','$email','$password','$id_localidad')";            
            $resultado=mysqli_query($conexion,$consulta);   
            if ($resultado) {
                echo '<div class="alert alert-success alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        Tu registro se ha completado con éxito.
                      </div>';
            }elseif (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['id_localidad'])) {
                echo '<div class="alert alert-danger alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        Por favor, completa todos los campos.
                      </div>';
            }
            
            
            } else {
                echo '<div class="alert alert-danger alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        Ha ocurrido un error en tu registro.
                      </div>';
            }
            
            
}

?>