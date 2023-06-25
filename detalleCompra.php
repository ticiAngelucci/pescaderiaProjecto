<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include_once('functions/cart.php');

// Guardar la sesión de los productos en una nueva variable
$nueva_sesion = $_SESSION['carrito'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cambiar los valores de sesión dentro del bucle foreach
    foreach ($nueva_sesion as $i => $valor) {
        $nueva_sesion[$i]['nombre'] = $_POST['nombre_' . $i];
        $nueva_sesion[$i]['precio_por_gramo'] = $_POST['precio_por_gramo_' . $i];
        $nueva_sesion[$i]['cantidad_disponible'] = $_POST['cantidad_disponible_' . $i];
        
        // Calcular el nuevo precio total
        $precio_total = $valor['precio_por_gramo'] * $valor['cantidad_disponible'];
        $nueva_sesion[$i]['precio_total'] = $precio_total;
    }
    
    // Calcular el nuevo total general
    $total_general = 0;
    foreach ($nueva_sesion as $valor) {
        $total_general += $valor['precio_total'];
    }
    
    // Actualizar la variable de sesión 'carrito' con la nueva sesión
    $_SESSION['carrito'] = $nueva_sesion;
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
                $total_general = 0;
                $productos = array();
                foreach ($nueva_sesion as $i => $valor) {
                    $producto_nombre = $valor['nombre'] . $i;
                    $producto_precio_por_gramo = $valor['precio_por_gramo'] . $i;
                    $producto_cantidad = $valor['cantidad_disponible'] . $i;
                    $precio_total = $valor['precio_por_gramo'] * $valor['cantidad_disponible'];
                    $total_general += $precio_total;

                    // Actualizar el precio total en el formulario
                    $nueva_sesion[$i]['precio_total'] = $precio_total;
                ?>
                <input style="display: none;" type="text" id="id_producto" name="id_producto"
                    value="<?php echo $valor['id_producto']; ?>">
                <tbody>
                    <tr>
                        <td><input name="nombre_<?php echo $i; ?>" type="text" value="<?php echo $valor['nombre']; ?>"
                                readonly /></td>
                        <td><input type="number" id="precio_por_gramo_<?php echo $i; ?>"
                                name="precio_por_gramo_<?php echo $i; ?>" class="form-control" min="1"
                                max="<?php echo $valor['precio_por_gramo']; ?>" readonly
                                value="<?php echo $valor['precio_por_gramo']; ?>"></td>
                        <td><input type="number" id="cantidad_disponible_<?php echo $i; ?>"
                                name="cantidad_disponible_<?php echo $i; ?>" class="form-control" min="1"
                                max="<?php echo $valor['cantidad_disponible']; ?>"
                                value="<?php echo $valor['cantidad_disponible']; ?>"
                                onchange="updatePrice(<?php echo $i; ?>);"></td>
                        <td><input type="number" id="precio_por_gramos_multiplicado<?php echo $i; ?>"
                                name="precio_por_gramos_multiplicado<?php echo $i; ?>" class="form-control" min="1"
                                readonly value="<?php echo $precio_por_gramos_multiplicado; ?>"></td>
                        <td><input type="number" id="precio_total_<?php echo $i; ?>"
                                name="precio_total_<?php echo $i; ?>" class="form-control" min="1" readonly
                                value="<?php echo $precio_total; ?>"></td>
                    </tr>
                </tbody>
                <?php
                }
                ?>
            </table>
            <!-- Input para mostrar el total general -->
            <div class="form-group">
                <label for="total_general">Total general:</label>
                <input type="number" id="total_general" name="total_general" readonly value="<?php echo $total; ?>"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="descripcion">Descripción del pedido:</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de retiro:</label>
                <input type="date" id="fecha" name="fecha" class="form-control">
            </div>
            <div class="form-group">
                <label for="horario">Horario de retiro:</label>
                <input type="time" id="horario" name="horario" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </div>
        <!-- Resto del código -->
    </form>
</div>

<script>
function updatePrice(index) {
    var cantidad = parseInt(document.getElementById('cantidad_disponible_' + index).value);
    var precioPorGramo = parseInt(document.getElementById('precio_por_gramo_' + index).value);
    var precioTotal = cantidad * precioPorGramo;
    document.getElementById('precio_total_' + index).value = precioTotal;
    //Actualizar cantidad por 100 para saber los gramos
    var precioPorGramosMultiplicado = cantidad * 100;
    document.getElementById('precio_por_gramos_multiplicado' + index).value = precioPorGramosMultiplicado;
    // Actualizar el total general
    var totalGeneral = 0;
    <?php foreach ($nueva_sesion as $i => $valor) { ?>
    var cantidad<?php echo $i; ?> = parseInt(document.getElementById('cantidad_disponible_<?php echo $i; ?>').value);
    var precioPorGramo<?php echo $i; ?> = parseInt(document.getElementById('precio_por_gramo_<?php echo $i; ?>').value);
    var precioTotal<?php echo $i; ?> = cantidad<?php echo $i; ?> * precioPorGramo<?php echo $i; ?>;
    totalGeneral += precioTotal<?php echo $i; ?>;
    <?php } ?>
    document.getElementById('total_general').value = totalGeneral;
}
</script>


<?php
if (!empty($nueva_sesion)) {
    foreach ($nueva_sesion as $key => $value) {
        echo "[$key] => ";
        if (is_array($value)) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        } else {
            echo $value;
        }
        echo "<br>";
    }
} else {
    echo "La variable \$nueva_sesion está vacía o no se ha asignado correctamente.";
}
include('components/footer.php');
?>