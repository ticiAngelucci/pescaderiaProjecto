<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
echo $id_usuario;
include('components/navbar.php');
$consulta = "SELECT * FROM pedidos where id_cliente='$id_usuario'";
$resultados = mysqli_query($conexion, $consulta);
?>
<div class="row justify-content-center text-center">
    <div class="col-md-8 col-lg-6">
        <div class="header" style="color:white;margin-top:30px;">
            <h2>Historial de Pedidos</h2>
            <form method="POST"><input type="text" name="busqueda"><input type="submit" value="buscar"
                    name="btnbuscar" />
            </form>
            <form method="post" style="margin-bottom:40px;">
                <div class="form-group">
                    <label for="ordenamiento">Ordenar por:</label>
                    <select class="form-control" id="ordenamiento" name="ordenamiento">
                        <option value="filtrar_empl">Filtrar solo empleados</option>
                        <option value="filtrar_cli">Filtrar solo clientes</option>
                        <option value="todo">Todo</option>
                    </select>
                </div>
                <button type="submit" name="btnfiltrar" class="btn btn-primary">Ordenar</button>
            </form>
        </div>
    </div>
</div>
<div class="containerPedidosHistorial" style="width: 100%;max-width: 900px;margin: auto;">
    <?php foreach($resultados as $pedido) {  ?>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header">
            Pedido <?php echo $pedido['id_pedido']?>
        </div>
        <div class="card-body" style="display: flex;justify-content: space-around;align-items: center;">
            <img class="card-img-top" src="assets/pedido.png" alt="Card image cap"
                style="width: 100%;max-width: 250px;">
            <div>
                <h5 class="card-title">Tu compra se realizo <?php echo $pedido['hora_fecha_now']?></h5>
                <p class="card-text" style="text-align: left;">Su compra se retira <?php echo $pedido['fecha_entrega_pedido']; echo "&nbsp;"; echo $pedido['hora_entrega_pedido']; ?></p>
                <p class="card-text" style="text-align: left;">El total a pagar es $ <?php echo $pedido['total_pedido']; ?></p>
                <a href="descripcionPedido.php" style="max-width: 150px;width: 100%;" class="btn btn-primary">Ver
                    más</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
 <?php include('components/footer.php');?>