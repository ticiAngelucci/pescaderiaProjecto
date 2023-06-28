<?php 
 include('components/header.php'); 
 include('functions/conection.php'); ?>
<div class="custom-container" style="margin-top:150px;">
    <h3>Registrarse</h3>
    <form method="post" action="functions/registrar.php">
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
            <input type="password" name="password" id="password" class="form-control"
                placeholder="Ingrese su contraseña">
        </div>
        <div class="form-group">
            <select id="id_localidad" name="id_localidad" class="form-select">
                <?php 
                    $queryLocalidad="SELECT * FROM localidades";            
                    $resultadosLocalidad=mysqli_query($conexion,$queryLocalidad); 
                    while ($localidad = $resultadosLocalidad->fetch_assoc()) { ?>
                <option value="<?php echo $localidad['id_localidad']; ?>"><?php echo $localidad['localidad']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <p><a href="" data-toggle="modal" data-target="#exampleModal">Tu localidad no aparece,te gustaria agregarla?</a>
        </p>
        <div class="form-group">
            <input type="submit" name="register" value="Registrarse" class="btn btn-primary">
        </div>
        <p><a href="login.php">¿Ya tienes una cuenta?</a></p>
    </form>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega tu localidad!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="functions/agregarLocalidad.php">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="Ingrese el nombre de la localidad">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="register" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>