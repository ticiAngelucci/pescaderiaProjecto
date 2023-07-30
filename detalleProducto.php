<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
include('components/navbar.php');
include('functions/conection.php');
include_once('functions/cart.php');
$id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id_producto == '' || $token == '') {
    echo 'Error al procesar la petición';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id_producto, KEY_TOKEN);
    if ($token == $token_tmp) {
        $consulta = "SELECT count(id_producto) FROM productos where id_producto='$id_producto'";
        $resultados = mysqli_query($conexion, $consulta);
        if ($resultados == null) {
            echo "Error";
        } else {
            $consulta = "SELECT id_producto, nombre, cantidad_disponible, precio_por_gramo, descripcion FROM productos where id_producto='$id_producto' limit 1";
            $resultados = mysqli_query($conexion, $consulta);
        }
    }
}

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
?>

<section id="services" class="services section-bg">
    <div class="container">
        <?php while ($producto = $resultados->fetch_assoc()) { ?>
        <div class="row">
            <div class="col-md-6">
                <div class="_product-images">
                    <div class="picZoomer">
                        <img src="<?php if (isset($productosConImg[$producto['nombre']])) {
                                            echo $productosConImg[$producto['nombre']];
                                        } else {
                                            echo $productosConImg['default'];
                                        } ?>" alt="producto" width="100%" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="_product-detail-content">
                    <p class="_p-name"><?php echo $producto['nombre']; ?></p>
                    <div class="_p-price-box">
                        <div class="p-list">
                            Precio por gramos: $
                            <?php echo number_format($producto['precio_por_gramo'], 2, '.', ','); ?>
                        </div>
                        <div class="_p-features">
                            <span> Descripción del producto: </span>
                            <?php echo $producto['descripcion']; ?>
                        </div>
                        <ul class="spe_ul"></ul>
                        <div class="_p-qty-and-cart">
                            <div class="_p-add-cart">
                                <a style="<?php if ($vista == 0) {
                                                        echo "display:none;";
                                                    } ?>"
                                    href="editarProducto.php?id_producto=<?php echo $producto['id_producto']; ?>&token=<?php echo hash_hmac('sha1', $producto['id_producto'], KEY_TOKEN); ?>"
                                    class="btn-theme btn buy-btn" tabindex="0">
                                    <i class="fa fa-shopping-cart"></i> Editar Producto
                                </a>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="id_producto"
                                        value="<?php echo $producto['id_producto']; ?>">
                                    <input type="hidden" name="nombre"
                                        value="<?php echo $producto['nombre']; ?>">
                                    <input type="hidden" name="precio_por_gramo"
                                        value="<?php echo $producto['precio_por_gramo']; ?>">
                                    <input type="hidden" name="cantidad_disponible"
                                        value="<?php echo $producto['cantidad_disponible']; ?>">
                                    <button class="btn btn-primary" name="accionBoton"
                                        style="<?php if($vista == 1){echo "display:none;";}?>" value="Agregar"
                                        type="submit">Agregar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<?php include('components/footer.php'); ?>