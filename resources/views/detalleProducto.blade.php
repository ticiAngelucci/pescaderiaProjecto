@include('header')
@include('navbar')
<?php
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
    <div class="container-fluid">
        <div class="row row-sm">
            <div class="col-md-6 _boxzoom">

                <div class="_product-images">
                    <div class="picZoomer">
                        <img src=<?php if(isset($productosConImg[$producto->nombre])) { echo $productosConImg[$producto->nombre]; } else{ echo $productosConImg['default'];}?>
                            alt="producto" width="260px">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="_product-detail-content">
                    <p class="_p-name">{{$producto->nombre}}</p>
                    <div class="_p-price-box">
                        <div class="p-list">
                            Precio por gramos: $ {{$producto->precio_por_gramo}}
                        </div>
                        <div class="_p-features">
                            <span> Descripcion del producto:- </span>
                            {{$producto->descripcion}}
                        </div>
                        <form action="" method="post" accept-charset="utf-8">
                            <ul class="spe_ul"></ul>
                            <div class="_p-qty-and-cart">
                                <div class="_p-add-cart">
                                    <a href="{{route('editarProducto',$producto->id_producto)}}"
                                        class="btn-theme btn buy-btn" tabindex="0">
                                        <i class="fa fa-shopping-cart"></i> Editar Producto
                                    </a>
                                    <button class="btn-theme btn btn-success" tabindex="0">
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
        </div>
    </div>
</section>