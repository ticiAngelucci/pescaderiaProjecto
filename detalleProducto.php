<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
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
 }
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
?>
<section id="services" class="services section-bg">
    <div class="container">
        <?php while ($producto = $resultados->fetch_assoc()) { ?>
        <div class="row">
            <div class="col-md-6">
                <div class="_product-images">
                    <div class="picZoomer">
                        <img src="<?php if(isset($productosConImg[$producto['nombre']])) { echo $productosConImg[$producto['nombre']]; } else{ echo $productosConImg['default'];}?>"
                            alt="producto" width="100%" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="_product-detail-content">
                    <p class="_p-name"><?php echo $producto['nombre']; ?></p>
                    <div class="_p-price-box">
                        <div class="p-list">
                            Precio por gramos: $ <?php echo number_format($producto['precio_por_gramo'],2,'.',','); ?>
                        </div>
                        <div class="_p-features">
                            <span> Descripcion del producto: </span>
                            <?php echo $producto['descripcion']; ?>
                        </div>
                        <form action="functions/cart.php" method="post" accept-charset="utf-8">
                            <ul class="spe_ul"></ul>
                            <div class="_p-qty-and-cart">
                                <div class="_p-add-cart">
                                    <a style="<?php if($vista==0){echo "display:none;";}?>"
                                        href="editarProducto.php?id_producto=<?php echo $producto['id_producto'];?>&token=<?php echo hash_hmac('sha1',$producto['id_producto'],KEY_TOKEN); ?>"
                                        class="btn-theme btn buy-btn" tabindex="0">
                                        <i class="fa fa-shopping-cart"></i> Editar Producto
                                    </a>
                                    <button class="btn-theme btn btn-success"
                                        style="<?php if($vista==1){echo "display:none;";}?>" tabindex="0">
                                        <i class="fa fa-shopping-cart"></i> Añadir al carrito
                                    </button>
                                    <input type="hidden" name="pid" value="18" />
                                    <input type="hidden" name="price" value="850" />
                                    <input type="hidden" name="url" value="" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <<<<<<< HEAD <?php } ?>=======</div>
    </div>
    </div>
    <?php } ?>
    >>>>>>> lucaphp
    </div>
</section>

<?php include('components/footer.php'); ?>