<?php 
session_start();
include('components/header.php');
include('components/navbar.php');
include_once('functions/cart.php'); 
$carrito_mio=$_SESSION['carrito'];
?>
<div style="display: flex;justify-content: center;margin-top:40px;">
    <form action="procesarPedido.php" method="post" style="display:flex;">
        <h2>Listado de Productos</h2>
        <table class="table table-striped table-hover" style="background: white;margin: auto;max-width: 732px;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio por unidad</th>
                    <th>Cantidad</th>
                    <th>Precio total</th>
                </tr>
            </thead>
            <?php
                $i = 0;
                foreach ($carrito_mio as $valor) {
                    $i++;
                    $producto_nombre = $valor['nombre'] . $i;
                    $producto_precio_por_gramo = $valor['precio_por_gramo'] . $i;
                    $producto_cantidad = $valor['cantidad_disponible'] . $i;
            ?>
            <tbody>
                <tr>
                    <td><input name="nombre" type="text" value="<?php echo $valor['nombre']; ?>" /></td>
                    <td><input type="number" id="precio_por_gramo_<?php echo $i; ?>"
                            name="precio_por_gramo_<?php echo $i; ?>" class="form-control" min="1"
                            max="<?php echo $valor['precio_por_gramo']; ?>" readonly
                            value="<?php echo $valor['precio_por_gramo']; ?>"></td>
                    <td><input type="number" id="cantidad_disponible_<?php echo $i; ?>"
                            name="cantidad_disponible_<?php echo $i; ?>" class="form-control" min="1"
                            max="<?php echo $valor['cantidad_disponible']; ?>"
                            value="<?php echo $valor['cantidad_disponible']; ?>"></td>
                    <td><input type="number" id="preciototal_<?php echo $i; ?>" name="preciototal_<?php echo $i; ?>"
                            class="form-control" min="1" readonly></td>
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
                });

                var cantidadInicial = cantidadInput.value;
                var precioInicial = precioInput.value;
                var totalInicial = cantidadInicial * precioInicial;
                totalInput.value = totalInicial;
            })();
            </script>
            <?php
            }
            ?>
        </table>
        <div style="display: flex;flex-direction: column;">
            <label for="descripcion">Descripción del pedido:</label>
            <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            <label for="fecha">Fecha de retiro:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="horario">Horario de retiro:</label>
            <input type="time" id="horario" name="horario">

            <input type="submit" value="Enviar">
        </div>
    </form>
</div>

<?php 
include('components/footer.php');
?>