<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
include('components/navbar.php');

$selectedDateRange = "";

$consulta = "SELECT * FROM pedidos WHERE id_cliente='$id_usuario'";

if (isset($_POST['btnfiltrar'])) {
    $ordenarPor = $_POST['ordenar_por'];
    $orden = $_POST['orden'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];

    if (!empty($fechaInicio) && !empty($fechaFin)) {
        $consulta .= " AND fecha_entrega_pedido BETWEEN '$fechaInicio' AND '$fechaFin'";
        $selectedDateRange = "Se eligió entre " . date("d/m/Y", strtotime($fechaInicio)) . " y " . date("d/m/Y", strtotime($fechaFin));
    }

    $consulta .= " ORDER BY $ordenarPor $orden";
}

$resultados = mysqli_query($conexion, $consulta);

if (!$resultados) {
    echo "Error en la consulta: " . mysqli_error($conexion);
} else {
    if (mysqli_num_rows($resultados) === 0) {
        echo "<script>alert('No tiene pedidos.');</script>";
    }
}
?>

<?php if (mysqli_num_rows($resultados) === 0) { ?>
    <div style="display: flex; color: red; background: white; height: 50px; max-width: 100%; width: 300px; margin: 0 auto; justify-content: center; align-items: center; border-radius: 30px;">No tiene historial, por favor vuelva a inicio</div>
<?php    } else { ?>
    <div class="container" style="max-width: 1436px;">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6" style="padding-bottom:20px;">
                <div class="header" style="color:white;margin-top:30px;">
                    <h2>Historial de Pedidos</h2>
                    <form method="POST" class="mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ordenar_por">Ordenar por:</label>
                                    <select name="ordenar_por" id="ordenar_por" class="form-control">
                                        <option value="fecha_entrega_pedido">Fecha de entrega</option>
                                        <option value="hora_fecha_now">Fecha de compra</option>
                                        <option value="total_pedido">Total a pagar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="orden">Orden:</label>
                                    <select name="orden" id="orden" class="form-control">
                                        <option value="asc">Ascendente</option>
                                        <option value="desc">Descendente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio:</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de fin:</label>
                                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btnfiltrar" class="btn btn-primary">Filtrar</button>
                    </form>
                    <?php if (!empty($selectedDateRange)) { ?>
                        <p style="color: white;padding: 25px;"><?php echo $selectedDateRange; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <?php foreach ($resultados as $pedido) {  ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            Pedido <?php echo $pedido['id_pedido'] ?>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4">
                                <img class="card-img-top" src="assets/pedido.png" alt="Card image cap" style="width: 100%;max-width: 250px;">
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title">Su compra se retira
                                    <?php echo $pedido['fecha_entrega_pedido'];
                                    echo "&nbsp;";
                                    echo $pedido['hora_entrega_pedido']; ?>
                                </h5>
                                <p class="card-text" style="text-align:left;">Tu compra se realizó <?php echo $pedido['hora_fecha_now'] ?></p>
                                <p class="card-text" style="text-align:left;">El total a pagar es $
                                    <?php echo $pedido['total_pedido']; ?></p>
                                <a href="descripcionPedido.php?id_pedido=<?php echo $pedido['id_pedido']; ?>&token=<?php echo hash_hmac('sha1', $pedido['id_pedido'], KEY_TOKEN); ?>" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php include('components/footer.php'); ?>