<?php 
session_start();
include('components/header.php');
include('components/navbar.php'); 
include('functions/conection.php');
include('functions/config.php');
include_once('functions/cart.php');
$consulta = "SELECT id_producto, nombre, precio_por_gramo, cantidad_disponible FROM productos";            
$resultados = mysqli_query($conexion, $consulta); 
$activo = 0;
$filter = 0;

if(isset($_POST['btnbuscar'])){
    $activo = 1;
    $busqueda = $_POST['busqueda'];
    $consulta = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%'";            
    $queryBusqueda = mysqli_query($conexion, $consulta); 
}

if(isset($_POST['btnfiltrar'])){
    $ordenamiento = $_POST['ordenamiento'];
    $activo = 1;
    $filter = 1;
    if ($ordenamiento == 'nombre_asc') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM productos ORDER BY nombre ASC");
    } elseif ($ordenamiento == 'nombre_desc') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM productos ORDER BY nombre DESC");
    } elseif ($ordenamiento == 'precio_asc') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM productos ORDER BY precio_por_gramo ASC");
    } elseif ($ordenamiento == 'precio_desc') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM productos ORDER BY precio_por_gramo DESC");
    }
}
?>

<section class="section-products">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">
                <div class="header">
                    <h3>Escollera</h3>
                    <h2>Nuestros Productos</h2>
                </div>
            </div>
        </div>
        <form method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="buscar" name="btnbuscar" />
        </form>
        <form method="post" style="margin-bottom:40px;">
            <div class="form-group">
                <label for="ordenamiento">Ordenar por:</label>
                <select class="form-control" id="ordenamiento" name="ordenamiento">
                    <option value="nombre_asc">Nombre (A-Z)</option>
                    <option value="nombre_desc">Nombre (Z-A)</option>
                    <option value="precio_asc">Precio (menor a mayor)</option>
                    <option value="precio_desc">Precio (mayor a menor)</option>
                </select>
            </div>
            <button type="submit" name="btnfiltrar" class="btn btn-primary">Ordenar</button>
        </form>
    </div>
    <div class="row" style="max-width: 1100px !important;margin: auto !important;">
        <?php 
        if($activo == 0){
            foreach($resultados as $producto) {
        ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div id="product-1" class="single-product">
                <div class="part-1"
                    style="background: url(<?php if(isset($productosConImg[$producto['nombre']])) { echo $productosConImg[$producto['nombre']]; } else{ echo $productosConImg['default'];}?>) no-repeat center !important;">
                </div>
                <div class="part-2">
                    <h3 class="product-title"><?php echo $producto['nombre'];?></h3>
                    <h4 class="product-price">$<?php echo number_format($producto['precio_por_gramo'],2,'.',',');?></h4>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="detalleProducto.php?id_producto=<?php echo $producto['id_producto'];?>&token=<?php echo hash_hmac('sha1',$producto['id_producto'],KEY_TOKEN); ?>"
                            class="btn btn-primary">Detalles</a>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
                        <input type="hidden" name="precio_por_gramo"
                            value="<?php echo $producto['precio_por_gramo']; ?>">
                        <input type="hidden" name="cantidad_disponible"
                            value="<?php echo isset($producto['cantidad_disponible']) ? $producto['cantidad_disponible'] : ''; ?>">
                        <button class="btn btn-primary" name="accionBoton" value="Agregar"
                            type="submit">Agregar</button>
                    </form>

                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            if($filter == 0 && $activo == 1){
                foreach($queryBusqueda as $busquedaProducto) {
        ?>
        <div class="col-md-4 col-xl-3" style="margin-top:50px;">
            <div id="product-1" class="single-product">
                <div class="part-1"
                    style="background: url(<?php if(isset($productosConImg[$busquedaProducto['nombre']])) { echo $productosConImg[$busquedaProducto['nombre']]; } else{ echo $productosConImg['default'];}?>) no-repeat center !important;">
                </div>
                <div class="part-2">
                    <h3 class="product-title"><?php echo $busquedaProducto['nombre'];?></h3>
                    <h4 class="product-price">
                        $<?php echo number_format($busquedaProducto['precio_por_gramo'],2,'.',',');?></h4>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="detalleProducto.php?id_producto=<?php echo $busquedaProducto['id_producto'];?>&token=<?php echo hash_hmac('sha1',$busquedaProducto['id_producto'],KEY_TOKEN); ?>"
                            class="btn btn-primary">Detalles</a>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $busquedaProducto['id_producto']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $busquedaProducto['nombre']; ?>">
                        <input type="hidden" name="precio_por_gramo"
                            value="<?php echo $busquedaProducto['precio_por_gramo']; ?>">
                        <input type="hidden" name="cantidad_disponible"
                            value="<?php echo $busquedaProducto['cantidad_disponible']; ?>">
                        <button class="btn btn-primary" name="accionBoton" value="Agregar"
                            type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
                }
        } else {
            foreach($resultadosFiltrar as $resultadoFiltrar) {
        ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div id="product-1" class="single-product">
                <div class="part-1"
                    style="background: url(<?php if(isset($productosConImg[$resultadoFiltrar['nombre']])) { echo $productosConImg[$resultadoFiltrar['nombre']]; } else{ echo $productosConImg['default'];}?>) no-repeat center !important;">
                </div>
                <div class="part-2">
                    <h3 class="product-title"><?php echo $resultadoFiltrar['nombre'];?></h3>
                    <h4 class="product-price">
                        $<?php echo number_format($resultadoFiltrar['precio_por_gramo'],2,'.',',');?></h4>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="detalleProducto.php?id_producto=<?php echo $resultadoFiltrar['id_producto'];?>&token=<?php echo hash_hmac('sha1',$resultadoFiltrar['id_producto'],KEY_TOKEN); ?>"
                            class="btn btn-primary">Detalles</a>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $resultadoFiltrar['id_producto']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $resultadoFiltrar['nombre']; ?>">
                        <input type="hidden" name="precio_por_gramo"
                            value="<?php echo $resultadoFiltrar['precio_por_gramo']; ?>">
                        <input type="hidden" name="cantidad_disponible"
                            value="<?php echo $resultadoFiltrar['cantidad_disponible']; ?>">
                        <button class="btn btn-primary" name="accionBoton" value="Agregar"
                            type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }
        }
    }
    ?>
    </div>
    <center class="mt-5">
        <!--  {{ $productos->links('paginator') }} -->
    </center>
</section>

<?php include('components/footer.php'); ?>