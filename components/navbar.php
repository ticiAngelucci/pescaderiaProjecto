<?php
include('header.php');
include_once('functions/cart.php');
include('functions/config.php');
include('functions/delete_product.php');
$vista=0;
if (isset($_SESSION['usuario_tipo'])) {
    if($_SESSION['usuario_tipo']=='empleado'){
        $vista=1;
    }
}
if (isset($_SESSION['id_usuario'])) {
   $id=$_SESSION['id_usuario'];
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-white bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="inicio.php">
            <img style="margin-right: 800px;" class="logo horizontal-logo" width=100 src="assets/escollera.png"
                alt="forecastr logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto"
                style="display: flex;align-items: center;<?php if($vista==1){echo "margin-right: 174px;";}?>">
                <div class="dropdown">
                    <img onclick="myFunction()" class="dropbtn"
                        src="https://images.vexels.com/media/users/3/137047/isolated/preview/5831a17a290077c646a48c4db78a81bb-icono-de-perfil-de-usuario-azul.png"
                        width=30 />
                    <div id="myDropdown" class="dropdown-content">
                        <a class="dropdown-item" href="editarUsuario.php?tipo_usuario=<?php if ($vista==0){echo "clientes";}else{echo "empleados";}?>&id_usuario=<?php echo $id;?>&token=<?php echo hash_hmac('sha1',$id,KEY_TOKEN); ?>">Editar Usuario</a>
                        <a style="<?php if($vista==0){echo "display:none;";}?>" class="dropdown-item"
                            href="listadoUsuarios.php">Listado de Usuario</a>
                        <a class="dropdown-item" href="historial.php">Historial</a>
                        <a class="dropdown-item" href="functions/logout.php">Cerrar Sesion</a>
                    </div>
                </div>
                <li style="<?php if($vista==1){echo "display:none;";}?>" class="nav-item">
                    <a class="nav-link" href="quienesSomos.php">¿Quienes somos?</a>
                </li>
                <!-- Enlace del carrito de compras con modal -->
                <li style="<?php if($vista==1){echo "display:none;";}?>" class="nav-item">
                    <a class="nav-link" id="cartLink" href="#" data-toggle="modal" data-target="#modal">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4RLdcADFuofIEayYB56NsmNwD5u5GL6KMQe5d6w0&s"
                            width="30" />
                        <span id="cartCount"
                            class="badge badge-pill badge-secondary"><?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Carrito de compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
                <ul class="list-group">
                    <?php foreach ($_SESSION['carrito'] as $key => $producto): ?>
                    <?php if (isset($producto['nombre']) && isset($producto['precio_por_gramo']) && isset($producto['cantidad_disponible'])): ?>
                    <?php
                                $cantidadDisponible = intval($producto['cantidad_disponible']);
                                $precioTotal = intval($producto['precio_por_gramo']) * intval($producto['cantidad_disponible']);
                                ?>
                    <li class="list-group-item">
                        <?php echo $producto['nombre']; ?> -
                        Cantidad:
                        <input type="number" min="0" max="<?php echo $cantidadDisponible; ?>"
                            value="<?php echo $cantidadDisponible; ?>" class="quantity-input"
                            data-key="<?php echo $key; ?>">
                        - Precio:
                        <span id="price_<?php echo $key; ?>"><?php echo '$' . $precioTotal; ?></span>
                        <button class="btn btn-danger btn-sm delete-button"
                            data-key="<?php echo $key; ?>">Eliminar</button>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Total: $<span id="cartTotal"><?php echo $total; ?></span></strong></p>
                <?php else: ?>
                <p>No hay productos en el carrito</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Realizar compra</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.quantity-input').on('change', function() {
        var key = $(this).data('key');
        var quantity = parseInt($(this).val());
        var pricePerGram = parseInt(<?php echo $producto['precio_por_gramo']; ?>);
        var totalPrice = quantity * pricePerGram;
        $('#price_' + key).text('$' + totalPrice);
        calculateTotal();
    });

    $('.delete-button').on('click', function() {
        var key = $(this).data('key');
        $.ajax({
            type: "POST",
            url: "functions/delete_product.php",
            data: {
                key: key
            },
            success: function(response) {
                if (response === 'success') {
                    location.reload();
                }
            }
        });
    });

    function calculateTotal() {
        var total = 0;
        $('.quantity-input').each(function() {
            var key = $(this).data('key');
            var quantity = parseInt($(this).val());
            var pricePerGram = parseInt(<?php echo $producto['precio_por_gramo']; ?>);
            var totalPrice = quantity * pricePerGram;
            $('#price_' + key).text('$' + totalPrice);
            total += totalPrice;
        });
        $('#cartTotal').text(total);
    }
});
</script>

<?php include('footer.php'); ?>