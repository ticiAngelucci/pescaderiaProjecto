<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include_once('functions/cart.php'); 
$carrito_mio = $_SESSION['carrito'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cambiar los valores de sesión dentro del bucle foreach
    foreach ($carrito_mio as $i => $valor) {
        $carrito_mio[$i]['nombre'] = $_POST['nombre_' . $i];
        $carrito_mio[$i]['precio_por_gramo'] = $_POST['precio_por_gramo_' . $i];
        $carrito_mio[$i]['cantidad_disponible'] = $_POST['cantidad_disponible_' . $i];
    }
    $_SESSION['carrito'] = $carrito_mio;
}
?>
<div class="container" style="margin-top: 40px;background-color: aliceblue;padding:40px">
    <form action="functions/procesarPedido.php" method="post" class="row">
        <div class="col-md-8">
            <h2>Listado de Productos</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio por unidad</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <?php
                $total = 0; 
                $productos = array();
                foreach ($carrito_mio as $i => $valor) {
                    $producto_nombre = $valor['nombre'] . $i;
                    $producto_precio_por_gramo = $valor['precio_por_gramo'] . $i;
                    $producto_cantidad = $valor['cantidad_disponible'] . $i;
                    $precio_total = $valor['cantidad_disponible'] * $valor['precio_por_gramo']; 
                    $total += $precio_total; 
                ?>
                <input style="display: none;" type="text" id="id_producto" name="id_producto" value="<?php echo $valor['id_producto']; ?>">
                    <tbody>
                        <tr>
                            <td><input name="nombre_<?php echo $i; ?>" type="text" value="<?php echo $valor['nombre']; ?>" readonly /></td>
                            <td><input type="number" id="precio_por_gramo_<?php echo $i; ?>"
                                    name="precio_por_gramo_<?php echo $i; ?>" class="form-control" min="1"
                                    max="<?php echo $valor['precio_por_gramo']; ?>" readonly
                                    value="<?php echo $valor['precio_por_gramo']; ?>"></td>
                            <td><input type="number" id="cantidad_disponible_<?php echo $i; ?>"
                                    name="cantidad_disponible_<?php echo $i; ?>" class="form-control" min="1"
                                    max="<?php echo $valor['cantidad_disponible']; ?>"
                                    value="<?php echo $valor['cantidad_disponible']; ?>"></td>
                            <td><input type="number" id="preciototal_<?php echo $i; ?>" name="preciototal_<?php echo $i; ?>"
                                    class="form-control" min="1" readonly value="<?php echo $precio_total; ?>"></td>
                        </tr>
                    </tbody>
                    <!-- Resto del código -->
                <?php
                }
                ?>
            </table>
            <!-- Input para mostrar el total general -->
            <div class="form-group">
                <label for="total_general">Total general:</label>
                <input type="number" id="total_general" name="total_general" readonly value="<?php echo $total; ?>" class="form-control">
            </div>
        </div>
        <!-- Resto del código -->
    </form>
</div>

<?php 
include('components/footer.php');
?>
