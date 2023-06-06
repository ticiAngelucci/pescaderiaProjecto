<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <h3>Registrarse</h3>
        <form method="post">

            <input class="" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
            <div></div>
            <input class="" type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
            <div></div>
            <input type="text" name="dni" class="dni-input" placeholder="Ingrese su dni">
            <div></div>
            <input class="" type="text" name="email" id="email" placeholder="Ingrese su email">
            <div></div>
            <input class="" type="text" name="id_localidad" id="id_localidad" placeholder="Ingrese su localidad">
            <div></div>
            <input class="" type="password" name="password" id="password" placeholder="Ingrese su contraseña">
            <div></div>
            <input type="radio" name="sexo" value="H" /> Cliente
            <input type="radio" name="sexo" value="M" /> Empleado
            <p></p>
            <input class="brn" type="submit" name="register" value=" Registrarse">
            <p><a href="#">¿Ya tiene cuenta?</a></p>
        </form>

    </div>
    <?php 
        include("registrar.php");
        
        ?>


</body>

</html>