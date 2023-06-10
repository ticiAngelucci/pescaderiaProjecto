<?php 
 include('components/header.php'); 
 include('components/navbar.php'); 
 include('functions/conection.php'); 
 include('functions/config.php');
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
            $consulta="SELECT id_producto,nombre,cantidad_disponible,precio_por_gramo,descripcion FROM productos where id_producto='$id_producto' limit 1";            
            $resultados=mysqli_query($conexion,$consulta); 
            
        }
    }
 }?>
<div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">
        <form class="form-horizontal" method="post">
            <legend>Editar mensaje</legend>
            <?php while ($producto = $resultados->fetch_assoc()) { ?>
            <div class="form-group">
                <label for="titulo" class="col-lg-label">Título</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="<?php echo $producto['nombre']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-lg-label">Contenido</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="contenido"
                        name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="precio_por_gramo">Precio por gramo:</label>
                <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control"
                    placeholder="<?php echo $producto['precio_por_gramo']; ?>">

            </div>
            <div class="form-group">
                <label for="id_estado_producto">Estado Producto</label>
                <select id="id_estado_producto" name="id_estado_producto" class="form-select">
                        <?php 
                        $consulta="SELECT * FROM estado_producto";   
                        $resultado=mysqli_query($conexion,$consulta);
                        foreach($resultado as $valor) { 
                            $id=$valor['id_estado_producto '];
                            $nombre=$valor['estado_producto'];
                            echo "<option value=$id>$nombre</option>";
                        } 
                        ?>
                </select>

            </div>
            <div class="form-group">
                <label for="id_categoria">Categoria Producto</label>
                <select id="id_categoria" name="id_categoria" class="form-select">
                        <?php 
                        $consulta="SELECT * FROM categorias";   
                        $resultado=mysqli_query($conexion,$consulta);
                        foreach($resultado as $valor) { 
                            $id=$valor['id_categoria'];
                            $nombre=$valor['nombre'];
                            echo "<option value=$id>$nombre</option>";
                        } 
                        ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad_disponible">Cantidad del Producto en gramos:</label>
                <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control"
                    placeholder="<?php echo $producto['cantidad_disponible']; ?>">

            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-default">Cancelar</button>
                    <button type="submit" name="editarProducto" class="ntm btn-primary">Actualizar</button>
                </div>
            </div>
            <?php } ?>
        </form>
    </div>
</div>
<?php 
include("functions/editarProducto.php");
include('components/footer.php'); ?>