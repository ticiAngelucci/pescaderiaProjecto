<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
$vista=0;
if (!isset($_SESSION['usuario_tipo'])) {
    if($_SESSION['usuario_tipo']=='empleado'){
        $vista=1;
    }
}
echo $vista;
include('components/navbar.php'); 
include('functions/conection.php');
include('functions/config.php');
include_once('functions/cart.php');
$productosConImg = [
    'langostino' => 'https://d3ugyf2ht6aenh.cloudfront.net/stores/001/215/401/products/lango-pelado1-5ff98af31ed78eae3b16496944392552-1024-1024.jpeg',
    'camaron' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGlb4HIOzaEyeUKma9JthR-OIy0-eB6hCM5JjWv-O9bU5QZkNimdIuUI3iWkuBwQDZJS4&usqp=CAU',
    'Doritos' => 'https://http2.mlstatic.com/D_NQ_NP_693032-MLA46951185556_082021-O.jpg',
    'pringles' => 'https://jumboargentina.vtexassets.com/arquivos/ids/766445/Papas-Pringles-Original-X124gs-1-944089.jpg?v=638104306094430000',
    'merluza' => 'https://www.consumer.es/app/uploads/fly-images/240582/merluza-de-pincho-1200x550-cc.jpg',
    'salmon' => 'https://ichef.bbci.co.uk/news/640/amz/worldservice/live/assets/images/2014/12/10/141210153740_salmon_promos__624x351_thinkstock.jpg',
    'queeeeedate' => 'https://www.billboard.com/wp-content/uploads/2023/01/Quevedo-2023-billboard-espanol-1548.jpg?w=942&h=623&crop=1&resize=942%2C623',
    'sprite' => 'https://d3ugyf2ht6aenh.cloudfront.net/stores/001/188/828/products/images-111-ae3485bd0f9a65d0be16529739175163-640-0.jpg',
    'default' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIZcQj0m_KyB8nZOnvGmDjb50YpXC3b3OmiobpDM0kejAScsWT_bpl_QGeUTUIUyWCT0s&usqp=CAU',
 ];
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
    <h2><?php echo $_SESSION['usuario_tipo']?></h2>
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
                        <button class="btn btn-primary" style="<?php if($vista == 0){echo "display:none;";}?>"
                            name="accionBoton" value="Agregar" type="submit">Agregar</button>
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
                        <button class="btn btn-primary" name="accionBoton" style="<?php if($vista == 0){echo "display:none;";}?>" value="Agregar"
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
                        <button class="btn btn-primary" name="accionBoton" style="<?php if($vista == 0){echo "display:none;";}?>" value="Agregar"
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