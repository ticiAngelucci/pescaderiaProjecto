<?php 
 include('components/header.php'); 
 include('components/navbar.php');
 include("functions/conection.php");
 include('functions/config.php');

 $tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : '';
 $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
 $token = isset($_GET['token']) ? $_GET['token'] : '';
 if($id_usuario =='' || $token =='' || $tipo_usuario==''){
    echo 'Error al procesar peticion';
    exit;
 }else{
    $token_tmp = hash_hmac('sha1', $id_usuario, KEY_TOKEN);
    if($token == $token_tmp){
        $consulta="SELECT * FROM $tipo_usuario where id='$id_usuario'";            
        $resultados=mysqli_query($conexion,$consulta); 
        if($resultados == null){
            echo "Error";
        }else{
            $consulta="SELECT * FROM $tipo_usuario where id='$id_usuario' limit 1";            
            $resultados=mysqli_query($conexion,$consulta); 
            
        }
    }
 }  ?>
<div class="container">
    <section class="py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <?php 
                    while ($usuario = $resultados->fetch_assoc()) { ?>
                        <div class="col-md-4 gradient-custom text-center my-5">
                            <img src="assets/perfilUsuario.png" alt="Avatar" style="width: 150px;" />
                            <h5 class="p-3"><?php echo $usuario['nombre']; ?></h5>
                            <h5><?php echo $usuario['apellido']; ?></h5>
                            <h5><?php echo $usuario['dni']; ?></h5>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Informacion del Usuario</h6>
                                <hr class="mt-0 mb-4">
                                <form id="editarUsuarioForm" method="POST" action="functions/editarUsuario.php">
                                    <input style="display: none;" type="text" id="id" name="id"
                                        value="<?php echo $id_usuario; ?>">
                                    <input style="display: none;" type="text" id="tipo_usuario" name="tipo_usuario"
                                        value="<?php echo $tipo_usuario; ?>">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" />
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Localidad</h6>
                                        <select id="id_localidad" name="id_localidad" class="form-select">
                                            <?php 
                                                $idLocalidad = $usuario['id_localidad'];
                                                $queryLocalidad="SELECT * FROM localidades where id_localidad='$idLocalidad' limit 1";            
                                                $resultadosLocalidad=mysqli_query($conexion,$queryLocalidad); 
                                                while ($localidad = $resultadosLocalidad->fetch_assoc()) { ?>
                                                    <option value="<?php echo $localidad['id_localidad']; ?>"
                                                    selected><?php echo $localidad['localidad']; ?></option>
                                            <?php } ?>
                                            <?php 
                                                $consulta="SELECT * FROM localidades";   
                                                $resultado=mysqli_query($conexion,$consulta);
                                                foreach($resultado as $valor) { 
                                                    $id=$valor['id_localidad'];
                                                    $nombre=$valor['localidad'];
                                                    if($idLocalidad==$id){

                                                    }else{
                                                        echo "<option value=$id>$nombre</option>";
                                                    }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Contraseña</h6>
                                        <input type="text" name="password"
                                            value="<?php echo $usuario['password']; ?>" />
                                    </div>
                                    <div class="col-6 mb-3">

                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('components/footer.php'); ?>