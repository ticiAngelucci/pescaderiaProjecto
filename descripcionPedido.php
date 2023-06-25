<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
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
        $consulta = "SELECT * FROM pedidos where id_pedido='$id_pedido'";
        $resultados = mysqli_query($conexion, $consulta);
        if ($resultados == null) {
            echo "Error";
        } else {
            /* $consulta = "SELECT id_producto, nombre, cantidad_disponible, precio_por_gramo, descripcion FROM productos where id_producto='$id_producto' limit 1";
            $resultados = mysqli_query($conexion, $consulta); */
        }
    }
}
?>
<div style="display: flex;justify-content: space-around;margin-top:40px;">
    <div class="card bg-light">
        <div class="card-body">
        <?php foreach($resultados as $pedido) { echo $pedido['id_pedido']; }?>
            <h5 class="card-title">Pedido</h5>
            <div class="d-flex align-items-center" style="flex-direction: column;">
                <table class="table table-striped table-hover" style="background: white;margin: auto;max-width: 732px;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>eeeeeeeeee</td>
                            <td>e</td>
                            <td>e</td>
                            <td>e</td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-text">
                    <p>Entrega:</p>
                    <p>Total:</p>
                </div>

            </div>
        </div>
    </div>
    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Estado del Pedido</h5>
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                    style="width: 50px; height: 50px;">
                    <img class="card-img-top" src="assets/flecha.png" alt="Card image cap" style="margin-top:109px;">
                </div>
                <p class="ml-3 mb-0" style="font-size: 18px;">Texto al lado del círculo</p>
            </div>
        </div>
    </div>
</div>

<?php 
include('components/footer.php');
?>