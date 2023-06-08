<?php 
 include('components/header.php'); 
 include('components/navbar.php'); ?>
<div class="custom-container">
    <h3>Registrarse</h3>
    <form method="post">
        <div class="form-group">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre">
        </div>
        <div class="form-group">
            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese su apellido">
        </div>
        <div class="form-group">
            <input type="text" name="dni" id="dni" class="form-control" placeholder="Ingrese su dni">
        </div>
        <div class="form-group">
            <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese su email">
        </div>
        <div class="form-group">
            <input type="text" name="id_localidad" id="id_localidad" class="form-control"
                placeholder="Ingrese su localidad">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control"
                placeholder="Ingrese su contraseña">
        </div>
        <div class="form-group">
            <input type="submit" name="register" value="Registrarse" class="btn btn-primary">
        </div>
        <p><a href="">¿Ya tienes una cuenta?</a></p>
    </form>
</div>

<?php 
        include("functions/registrar.php");
    ?>

<?php include('components/footer.php'); ?>