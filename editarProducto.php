<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
 include('components/navbar.php');
 include("functions/conection.php");
 $id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';
 $token = isset($_GET['token']) ? $_GET['token'] : '';
 if($id_producto =='' || $token ==''){
    echo 'Error al procesar peticion';
    exit;
 }else{
    $token_tmp = hash_hmac('sha1', $id_producto, KEY_TOKEN);
    if($token == $token_tmp){
        $consulta="SELECT count(id_producto) FROM productos where id_producto='$id_producto'";            
        $resultados=mysqli_query($conexion,$consulta); 
        if($resultados == null){
            echo "Error";
        }else{
            $consulta="SELECT id_producto,nombre,cantidad_disponible,precio_por_gramo,descripcion,id_estado_producto,id_categoria FROM productos where id_producto='$id_producto' limit 1";            
            $resultados=mysqli_query($conexion,$consulta); 
            
        }
    }
 }  ?>
<div class="container">
    <h4 class="d-flex justify-content-center mt-5 display-5">Editar producto!</h4>
    <?php while ($producto = $resultados->fetch_assoc()) { ?>
    <form id="editarProductoForm" method="POST" action="functions/editarProducto.php">
    <input style="display: none;" type="text" id="id_producto" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <div class="row g-2 py-5">
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $producto['nombre']; ?>">
                    <label for="nombre">Nombre del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                    value="<?php echo $producto['descripcion']; ?>">
                    <label for="descripcion">Descripcion del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <select id="id_categoria" name="id_categoria" class="form-select">
                    <?php 
                    $idCategoria = $producto['id_categoria'];
                    $queryCategoria="SELECT * FROM categorias where id_categoria='$idCategoria' limit 1";            
                    $resultadosCategoria=mysqli_query($conexion,$queryCategoria); 
                    while ($categoria = $resultadosCategoria->fetch_assoc()) { ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>" selected><?php echo $categoria['nombre']; ?></option>
                    <?php } ?>
                        <?php 
                        $consulta="SELECT * FROM categorias";   
                        $resultado=mysqli_query($conexion,$consulta);
                        foreach($resultado as $valor) { 
                            $id=$valor['id_categoria'];
                            $nombre=$valor['nombre'];
                            if($idCategoria==$id){

                            }else{
                                echo "<option value=$id>$nombre</option>";
                            }
                        } 
                        ?>
                    </select>
                    <label for="id_categoria">Categoria Producto</label>
                    <p><a href="" data-toggle="modal" style="color:black;margin-top:10px;" data-target="#exampleModal">Agregar nueva categoria</a>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control"
                    value="<?php echo $producto['precio_por_gramo']; ?>">
                    <label for="precio_por_gramo">Precio por gramo:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <select id="id_estado_producto" name="id_estado_producto" class="form-select">
                    <?php 
                    $idEstadoProducto = $producto['estado_producto'];
                    $queryEstadoProducto="SELECT * FROM estado_producto where id_estado_producto='$idEstadoProducto' limit 1";            
                    $resultadosEstadoProducto=mysqli_query($conexion,$queryEstadoProducto); 
                    while ($estadoProducto = $resultadosEstadoProducto->fetch_assoc()) { ?>
                    <option value="<?php echo $estadoProducto['id_estado_producto']; ?>" selected><?php echo $estadoProducto['nombre']; ?></option>
                    <?php } ?>
                        <?php 
                        $consulta="SELECT * FROM estado_producto";   
                        $resultado=mysqli_query($conexion,$consulta);
                        foreach($resultado as $valor) { 
                            $id=$valor['id_estado_producto'];
                            $nombre=$valor['estado_producto'];
                            if($idEstadoProducto==$id){

                            }else{
                                echo "<option value=$id>$nombre</option>";
                            }
                        } 
                        ?>
                    </select>
                    <label for="id_estado_producto">Estado Producto</label>
                    <p><a href="" data-toggle="modal" style="color:black;margin-top:10px;" data-target="#estadoProductoModal">Agregar nuevo estado de producto</a>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control"
                    value="<?php echo $producto['cantidad_disponible']; ?>">
                    <label for="cantidad_disponible">Cantidad del Producto en gramos:</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar!</button>
    </form>
    <?php } ?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega nueva categoria!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="functions/agregarCategoria.php">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="Ingrese el nombre de la categoria">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="register" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="estadoProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega nuevo estado del producto!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="functions/agregarEstadoProducto.php">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="Ingrese el nombre del estado del producto">
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