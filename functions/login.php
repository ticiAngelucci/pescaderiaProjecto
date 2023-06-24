<?php
session_start();
include("conection.php");
if (!empty($_POST["btningresar"])) {
    if (empty($_POST["email"]) and empty($_POST["password"])) {
        echo '<div class="alert alert-danger">Campos vacios</div>';
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $consulta = $conexion->query("select * from clientes where email='$email' limit 1");
        if (mysqli_num_rows($consulta) !== 0) {
            if (!empty($password)) {
                $consulta = $conexion->query("select * from clientes where email='$email' and password='$password'");
                if (mysqli_num_rows($consulta) !== 0) {
                    if ($datos = $consulta->fetch_object()) {
                        $_SESSION['id_usuario'] = $datos->id;
                        $_SESSION['usuario_tipo'] =  'cliente';
                        header("location:inicio.php");
                    }
                } else {
                    echo '<div class="alert alert-danger">La contraseña es incorrecta</div>';
                }
            } else {
                echo '<div class="alert alert-danger">La contraseña esta vacia</div>';
            }
        } else {
            $consulta = $conexion->query("select * from empleados where email='$email' limit 1");
            if (mysqli_num_rows($consulta) !== 0) {
                if (!empty($password)) {
                    $consulta = $conexion->query("select * from empleados where email='$email' and password='$password'");
                    if (mysqli_num_rows($consulta) !== 0) {
                        if ($datos = $consulta->fetch_object()) {
                            $_SESSION['id_usuario'] = $datos->id;
                            $_SESSION['usuario_tipo'] =  'empleado';
                            header("location:inicio.php");
                        }
                    } else {
                        echo '<div class="alert alert-danger">La contraseña es incorrecta</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">La contraseña esta vacia</div>';
                }
            } else {
                echo '<div class="alert alert-danger">No existe cuenta</div>';
            }
        }
    }
}
