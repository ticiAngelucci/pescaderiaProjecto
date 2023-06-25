<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit();
}
include('components/navbar.php');
$id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id_pedido == '' || $token == '') {
    echo 'Error al procesar la petición';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id_pedido, KEY_TOKEN);
    if ($token == $token_tmp) {
        $consulta = "SELECT * FROM pedidos WHERE id_pedido='$id_pedido'";
        $resultados = mysqli_query($conexion, $consulta);
        if (!$resultados || mysqli_num_rows($resultados) == 0) {
            echo "Error al obtener los datos del pedido";
            exit;
        }
    } else {
        echo "Token inválido";
        exit;
    }
}
?>

<div class="row justify-content-center text-center" style="margin: 20px;">
    <div class="col-md-8 col-lg-6">
        <div class="card bg-light">
            <div class="card-body">
                <?php foreach ($resultados as $pedido) { ?>
                <h5 class="card-title">Pedido <?php echo $pedido['id_pedido'] ?></h5>
                <div class="d-flex align-items-center flex-column">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Peso (en gramos)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $consultaProductos = "SELECT * FROM carritos_de_compras WHERE id_pedido =" . $pedido['id_pedido'];
                                    $resultadoProductos = mysqli_query($conexion, $consultaProductos);
                                    if (!$resultadoProductos || mysqli_num_rows($resultadoProductos) == 0) {
                                        echo "No se encontraron productos para este pedido";
                                    } else {
                                        while ($producto = mysqli_fetch_assoc($resultadoProductos)) {
                                            $id_producto = $producto['id_producto'];
                                            $consultaNombre = "SELECT * FROM productos WHERE id_producto = $id_producto";
                                            $resultadoNombre = mysqli_query($conexion, $consultaNombre);
                                            if ($resultadoNombre && mysqli_num_rows($resultadoNombre) > 0) {
                                                $nombre = mysqli_fetch_assoc($resultadoNombre);
                                    ?>
                                <tr>
                                    <td><?php echo $nombre['nombre'] ?></td>
                                    <td><?php echo $producto['peso_del_producto'] ?></td>
                                </tr>
                                <?php
                                            } else {
                                                echo "No se encontró el nombre del producto";
                                            }
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-text">
                        <p>Entrega:
                            <?php echo $pedido['fecha_entrega_pedido']; ?>&nbsp;<?php echo $pedido['hora_entrega_pedido']; ?>
                        </p>
                        <p>Total: $<?php echo $pedido['total_pedido'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Estado del Pedido</h5>
                <?php
                foreach ($resultados as $pedido) {
                    $consultaEstadoProducto = "SELECT * FROM estados_pedidos WHERE id_pedido =" . $pedido['id_pedido'];
                    $resultadoEstadoProducto = mysqli_query($conexion, $consultaEstadoProducto);
                    foreach ($resultadoEstadoProducto as $estadoProducto) {
                        $id_estado = $estadoProducto['id_estado'];
                        $consultaEstadoNombre = "SELECT * FROM estados WHERE id_estado = $id_estado";
                        $resultadoEstadoNombre = mysqli_query($conexion, $consultaEstadoNombre);
                        foreach ($resultadoEstadoNombre as $nombreEstado) {
                ?>
                <div class="d-flex align-items-center" style="flex-direction: column;">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                    </div>
                    <img  src="assets/flecha.png" alt="Card image cap">
                    <p class="ml-3 mb-0" style="font-size: 18px;"><?php echo $nombreEstado['nombre']; ?></p>
                </div>
                <?php
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php
include('components/footer.php');
?>