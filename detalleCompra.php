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
            $i=0;
            foreach ($carrito_mio as $valor) {
                
            ?>
            <tbody>
                <tr>
                    <td><input name="nombre" type="text" value="<?php echo $valor['nombre']; ?>" /></td>
                    <td><input type="number" id="cantidad" name="cantidad" class="form-control" min="1"
                            max="<?php echo $producto['cantidad_disponible']; ?>"
                            value="<?php echo $producto['cantidad_disponible']; ?>"></td>
                    <td><input type="number" id="cantidad" name="cantidad" class="form-control" min="1"
                            max="<?php echo $producto['cantidad_disponible']; ?>"
                            value="<?php echo $producto['cantidad_disponible']; ?>"></td>
                    <td><input type="number" id="cantidad" name="cantidad" class="form-control" min="1"
                            max="<?php echo $producto['cantidad_disponible']; ?>"
                            value="<?php echo $producto['cantidad_disponible']; ?>">
                    </td>
                </tr>
            </tbody>
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