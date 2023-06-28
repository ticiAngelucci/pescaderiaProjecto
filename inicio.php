<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php'); 
include('functions/conection.php');
include_once('functions/cart.php');
$productosConImg = [
    'langostino' => 'https://d3ugyf2ht6aenh.cloudfront.net/stores/001/215/401/products/lango-pelado1-5ff98af31ed78eae3b16496944392552-1024-1024.jpeg',
    'camaron' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGlb4HIOzaEyeUKma9JthR-OIy0-eB6hCM5JjWv-O9bU5QZkNimdIuUI3iWkuBwQDZJS4&usqp=CAU',
    'sabalo' => 'https://www.elsemiarido.com/wp-content/uploads/2020/05/29-05-s%C3%A1balos-2.jpg',
    'mejillon' => 'https://s1.eestatic.com/2019/12/16/ciencia/nutricion/alimentacion-nutricion_452466117_140640558_1706x960.jpg',
    'merluza' => 'https://www.consumer.es/app/uploads/fly-images/240582/merluza-de-pincho-1200x550-cc.jpg',
    'salmon' => 'https://ichef.bbci.co.uk/news/640/amz/worldservice/live/assets/images/2014/12/10/141210153740_salmon_promos__624x351_thinkstock.jpg',
    'calamar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVEHKpBUYqeWw0WoPHuEqOVM-em6tXTlldNypT8h3h7v7RAPkfns0EfkCAX87pEFVcmxg&usqp=CAU',
    'mariscos' => 'https://i.blogs.es/82cc26/img_0435/1366_2000.webp',
    'default' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIZcQj0m_KyB8nZOnvGmDjb50YpXC3b3OmiobpDM0kejAScsWT_bpl_QGeUTUIUyWCT0s&usqp=CAU',
 ];
$consulta = "SELECT id_producto, nombre, precio_por_gramo, cantidad_disponible FROM productos";            
$resultados = mysqli_query($conexion, $consulta); 
$activo = 0;
$filter = 0;
$itemsPerPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;
$totalItems = mysqli_num_rows($resultados);
$totalPages = ceil($totalItems / $itemsPerPage);

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

if($activo == 0){
    $consulta = "SELECT id_producto, nombre, precio_por_gramo, cantidad_disponible FROM productos LIMIT $offset, $itemsPerPage";            
    $resultados = mysqli_query($conexion, $consulta);
} else {
    if($filter == 0 && $activo == 1){
        $consulta = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' LIMIT $offset, $itemsPerPage";
        $resultados = mysqli_query($conexion, $consulta);
    } else {
        $consulta = "SELECT * FROM productos LIMIT $offset, $itemsPerPage";            
        $resultados = $resultadosFiltrar;
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
                        <?php if($producto['cantidad_disponible']< 1){?>
                        <p style="color:red;">No hay disponible</p>
                        <?php } else{?>
                            <button class="btn btn-primary" style="<?php if($vista == 1){echo "display:none;";}?>"
                            name="accionBoton" value="Agregar" type="submit">Agregar</button>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>

    <div class="pagination-container">
        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
            <ul class="pagination">
                <?php if($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link"
                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Siguiente</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</section>

<?php include('components/footer.php'); ?>