<?php 
 include('components/header.php');
 include('components/navbar.php'); 
 include('functions/conection.php');
 include('functions/config.php');
 $consulta="SELECT id_producto,nombre,precio_por_gramo FROM productos";            
 $resultados=mysqli_query($conexion,$consulta); 
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
        <div class="row">
            <?php
                foreach($resultados as $producto) { ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div id="product-1" class="single-product">
                    <div class="part-1" style="background: url(<?php if(isset($productosConImg[$producto['nombre']])) { echo $productosConImg[$producto['nombre']]; } else{ echo $productosConImg['default'];}?>)
                         no-repeat center !important;">
                    </div>
                    <div class="part-2">
                        <h3 class="product-title"><?php echo $producto['nombre'];?></h3>
                        <h4 class="product-price">$ <?php echo number_format($producto['precio_por_gramo'],2,'.',',');?>
                            </h3>
                        </h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="detalleProducto.php?id_producto=<?php echo $producto['id_producto'];?>&token=<?php echo hash_hmac('sha1',$producto['id_producto'],KEY_TOKEN); ?>"
                                class="btn btn-primary">Detalles</a>
                        </div>
                        <a href="#" class="btn btn-success">Agregar</a>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
    <center class="mt-5">
        <!--  {{ $productos->links('paginator') }} -->
    </center>
</section>

<?php include('components/footer.php'); ?>