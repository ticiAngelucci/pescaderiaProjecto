<?php include('header.php'); ?>
<?php include('functions/cart.php'); ?>
<?php include_once('functions/cart.php');?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-white bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="inicio.php">
            <img style="margin-right: 800px;" class="logo horizontal-logo" width=100
                src="data:image/png;base64,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"
                alt="forecastr logo">
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
                        <span id="cartCount" class="badge badge-pill badge-secondary">0</span>
                    </a>
                </li>

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
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
                                // Mostrar los productos en el carrito (variable de sesión)
                                foreach ($_SESSION['carrito'] as $producto) {
                               echo $producto['nombre'] . ' - $' . $producto['precio_por_gramo'] . '<br>';
                                }
                                ?>
                                <div>
                                    <div class="p-2">
                                        <ul class="list-group mb-3">

                                            </strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class=" modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Realizar
                                    compra</button>
                            </div>
                        </div>
                    </div>
                </div>




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