<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
 include('components/navbar.php');
 include("functions/conection.php");  ?>
<div class="container">
    <h4 class="d-flex justify-content-center mt-5 display-5">Crear producto!</h4>
    <form id="crearProductoForm" method="POST" action="functions/crearProducto.php">
        <div class="row g-2 py-5">
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="merluza">
                    <label for="nombre">Nombre del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                        placeholder="descripcion de producto">
                    <label for="descripcion">Descripcion del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
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
                    <label for="id_categoria">Categoria Producto</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control"
                        placeholder="20">
                    <label for="precio_por_gramo">Precio por gramo:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
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
                    <label for="id_estado_producto">Estado Producto</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control"
                        placeholder="20">
                    <label for="cantidad_disponible">Cantidad del Producto en gramos:</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar!</button>
    </form>
</div>
<?php include('components/footer.php'); ?>