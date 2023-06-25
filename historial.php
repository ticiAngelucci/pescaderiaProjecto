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
if (isset($_POST['btnfiltrar'])) {
    $ordenarPor = $_POST['ordenar_por'];
    $orden = $_POST['orden'];

    $consulta .= " ORDER BY $ordenarPor $orden";
}

$resultados = mysqli_query($conexion, $consulta);

if (!$resultados) {
    echo "Error en la consulta: " . mysqli_error($conexion);
} else {
    if (mysqli_num_rows($resultados) === 0) {
        echo "No se encontraron resultados.";
    } 
}
?>
<div class="container" style="max-width: 1436px;">
    <div class="row justify-content-center text-center">
        <div class="col-md-8 col-lg-6">
            <div class="header" style="color:white;margin-top:30px;">
                <h2>Historial de Pedidos</h2>
                <form method="POST"
                    style="justify-content: center;align-items: flex-end;flex-wrap: nowrap;flex-direction: row;"
                    class="form-inline mt-2">
                    <div class="form-group mr-sm-2">
                        <label for="ordenar_por">Ordenar por:</label>
                        <select name="ordenar_por" id="ordenar_por" class="form-control">
                            <option value="fecha_entrega_pedido">Fecha de entrega</option>
                            <option value="hora_fecha_now">Fecha de compra</option>
                            <option value="total_pedido">Total a pagar</option>
                        </select>
                    </div>
                    <div class="form-group mr-sm-2">
                        <label for="orden">Orden:</label>
                        <select name="orden" id="orden" class="form-control">
                            <option value="asc">Ascendente</option>
                            <option value="desc">Descendente</option>
                        </select>
                    </div>
                    <button type="submit" name="btnfiltrar" class="btn btn-primary">Filtrar</button>
                </form>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php foreach($resultados as $pedido) {  ?>
            <div class="card mb-3">
                <div class="card-header">
                    Pedido <?php echo $pedido['id_pedido']?>
                </div>
                <div class="card-body row">
                    <div class="col-md-4">
                        <img class="card-img-top" src="assets/pedido.png" alt="Card image cap"
                            style="width: 100%;max-width: 250px;">
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">Tu compra se realizó <?php echo $pedido['hora_fecha_now']?></h5>
                        <p class="card-text" style="text-align:left;">Su compra se retira
                            <?php echo $pedido['fecha_entrega_pedido']; echo "&nbsp;"; echo $pedido['hora_entrega_pedido']; ?>
                        </p>
                        <p class="card-text" style="text-align:left;">El total a pagar es $
                            <?php echo $pedido['total_pedido']; ?></p>
                        <a href="descripcionPedido.php?id_pedido=<?php echo $pedido['id_pedido'];?>&token=<?php echo hash_hmac('sha1',$pedido['id_pedido'],KEY_TOKEN); ?>"" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include('components/footer.php');?>