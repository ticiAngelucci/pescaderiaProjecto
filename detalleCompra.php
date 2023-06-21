<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include_once('functions/cart.php'); 
$carrito_mio = $_SESSION['carrito'];
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
                $total = 0; // Variable para almacenar el total de los precios
                $productos = array();
                $i = 0;
                foreach ($carrito_mio as $valor) {
                    $producto = array(
                        'id_producto' => $valor['id_producto'],
                        'nombre' => $valor['nombre'],
                        'precio_por_gramo' => $valor['precio_por_gramo'],
                        'cantidad_disponible' => $valor['cantidad_disponible']
                    );
                    
                    $productos[] = $producto; 
                    $i++;
                    $producto_nombre = $valor['nombre'] . $i;
                    $producto_precio_por_gramo = $valor['precio_por_gramo'] . $i;
                    $producto_cantidad = $valor['cantidad_disponible'] . $i;
                    $precio_total = $valor['cantidad_disponible'] * $valor['precio_por_gramo']; // Calcula el precio total de cada producto
                    $total += $precio_total; // Suma el precio total al total general
                ?>
                <input style="display: none;" type="text" id="id_producto" name="id_producto" value="<?php echo $valor['id_producto']; ?>">
                    <tbody>
                        <tr>
                            <td><input name="nombre" type="text" value="<?php echo $valor['nombre']; ?>" readonly /></td>
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
                    <script>
                    (function() {
                        var cantidadInput = document.getElementById("cantidad_disponible_<?php echo $i; ?>");
                        var precioInput = document.getElementById("precio_por_gramo_<?php echo $i; ?>");
                        var totalInput = document.getElementById("preciototal_<?php echo $i; ?>");

                        cantidadInput.addEventListener("change", function() {
                            var cantidad = cantidadInput.value;
                            var precio = precioInput.value;
                            var total = cantidad * precio;
                            totalInput.value = total;

                            calcularTotal(); // Llama a la función para recalcular el total general
                        });

                        function calcularTotal() {
                            var nuevosTotales = document.querySelectorAll(
                                "[id^='preciototal_']"
                            ); // Selecciona todos los inputs de preciototal

                            var total = 0;
                            for (var j = 0; j < nuevosTotales.length; j++) {
                                total += parseFloat(nuevosTotales[j].value); // Suma los valores de los inputs de preciototal
                            }

                            // Actualiza el valor del total general
                            document.getElementById("total_general").value = total;
                        }

                        // Calcular el precio total inicial
                        var cantidadInicial = cantidadInput.value;
                        var precioInicial = precioInput.value;
                        var totalInicial = cantidadInicial * precioInicial;
                        totalInput.value = totalInicial;

                        calcularTotal(); // Llama a la función para calcular el total general inicial
                    })();
                    </script>
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
    </form>
</div>

<?php 
include('components/footer.php');
?>
