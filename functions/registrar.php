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
                alert("Se han guardado el registro");
                location.replace("../login.php");
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

    // Verificar si el DNI ya está registrado
    $consultaDNI = "SELECT dni FROM clientes WHERE dni = '$dni'";
    $resultadoDNI = mysqli_query($conexion, $consultaDNI);
    if (mysqli_num_rows($resultadoDNI) > 0) {
        echo '<script>
            alert("El DNI ingresado ya está registrado. Por favor, intente con otro.");
            location.replace("../registro.php");
        </script>';
        exit(); // Salir del script si el DNI ya está registrado
    }

    // Verificar si el correo electrónico ya está registrado
    $consultaEmail = "SELECT email FROM clientes WHERE email = '$email'";
    $resultadoEmail = mysqli_query($conexion, $consultaEmail);
    if (mysqli_num_rows($resultadoEmail) > 0) {
        echo '<script>
            alert("El correo electrónico ingresado ya está registrado. Por favor, intente con otro.");
            location.replace("../registro.php");
        </script>';
        exit(); // Salir del script si el correo electrónico ya está registrado
    }



    // Verificar los demás campos
    $camposFaltantes = array(); // Array para almacenar los nombres de los campos faltantes

    if (empty($nombre)) {
        $camposFaltantes[] = 'nombre';
    }

    if (empty($apellido)) {
        $camposFaltantes[] = 'apellido';
    }

    if (empty($dni)) {
        $camposFaltantes[] = 'DNI';
    }

    if (empty($id_localidad)) {
        $camposFaltantes[] = 'localidad';
    }

    if (!empty($camposFaltantes)) {
        $mensaje = "Complete los siguientes campos: " . implode(", ", $camposFaltantes);
        echo '<script>
            alert("' . $mensaje . '");
            location.replace("../registro.php");
        </script>';
        exit(); // Salir del script si faltan campos
    }

    // Insertar los datos en la base de datos
    $consulta = "INSERT INTO clientes (nombre, apellido, dni, email, password, id_localidad)
                 VALUES ('$nombre', '$apellido', '$dni', '$email', '$password', '$id_localidad')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo '<script>
            alert("Se ha registrado correctamente.");
            location.replace("../registro.php");
        </script>';
    } else {
        echo '<script>
            alert("Ha ocurrido un error al registrar. Por favor, vuelva a intentarlo.");
            location.replace("../registro.php");
        </script>';
    }
}
?>