<?php include('header.php'); ?>
<?php include('functions/cart.php'); ?>
<?php include_once('functions/cart.php'); 

//session_start();

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-white bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="inicio.php">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="quienesSomos.php">¿Quienes somos?</a>
                </li>
                <!-- Enlace del carrito de compras con modal -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal">
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
                <?php
                // Verificar si hay productos en el carrito
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito']))  {
                    $total = 0; // Variable para almacenar el total del carrito
                    ?>
                <ul class="list-group">
                    <?php
                        // Recorrer los productos en el carrito y mostrarlos
                        foreach ($_SESSION['carrito'] as $producto) {
                            if (isset($producto['nombre']) && isset($producto['precio_por_gramo']) && isset($producto['cantidad_disponible'])) {
                                ?>
                    <li class="list-group-item">
                        <?php echo $producto['nombre']; ?> -
                        <?php echo '$' . number_format(floatval($producto['precio_por_gramo']) * intval($producto['cantidad_disponible']), 2); ?>

                        - Cantidad: <?php echo $producto['cantidad_disponible']; ?> Gramos
                    </li>
                    <?php
                                // Calcular el total del carrito multiplicando el precio por gramo por la cantidad de cada producto
                                $precioTotal = intval($producto['precio_por_gramo']) * intval($producto['cantidad_disponible']);
                                $total += $precioTotal; // Acumular el total del carrito
                            }
                        }
                        ?>


                </ul>
                <p><strong>Total: $<?php echo $total; ?></strong></p>
                <?php
                } else {
                    echo '<p>No hay productos en el carrito</p>';
                }
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Realizar compra</button>
            </div>
        </div>
    </div>
</div>

<!-- Resto del código HTML -->


<div class="dropdown">
    <img onclick="myFunction()" class="dropbtn"
        src="https://images.vexels.com/media/users/3/137047/isolated/preview/5831a17a290077c646a48c4db78a81bb-icono-de-perfil-de-usuario-azul.png"
        width=30 />
    <div id="myDropdown" class="dropdown-content">
        <a class="dropdown-item" href="editarUsuario.php">Editar Usuario</a>
        <a class="dropdown-item" href="#">Historial</a>
        <a class="dropdown-item" href="#">Cerrar Sesion</a>
    </div>
</div>

</ul>
</div>
</div>
</nav>

<?php include('footer.php'); ?>