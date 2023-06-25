<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include('functions/pedido.php');
$consulta = "SELECT * FROM estados_pedidos";
$resultados = mysqli_query($conexion, $consulta);
?>

<div class="row justify-content-center text-center">
    <div class="col-md-8 col-lg-6">
        <div class="header" style="color:white;margin-top:30px;">
            <h2>Historial de Pedidos</h2>
            <div class="input-group mb-3">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" name="btnbuscar">Buscar</button>
                </div>
            </div>
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
    <?php foreach ($resultados as $pedido) { ?>
    <div class="card" style="margin-top:50px;">
        <div class="card-header">
            Pedido <?php echo $pedido['id_pedido']; ?>
        </div>
        <div class="card-body">
            <div>
                <h5 class="card-title">El pedido de
                    <?php
                        $consultaNombre = "SELECT clientes.nombre FROM pedidos INNER JOIN clientes ON pedidos.id_cliente=clientes.id where id_pedido =" . $pedido['id_pedido'];
                        $resultadoNombre = mysqli_query($conexion, $consultaNombre);
                        foreach ($resultadoNombre as $nombre) {
                            echo $nombre['nombre'];
                        }
                        ?>
                </h5>
                <p class="card-text" style="text-align: left;">Su compra se realizó el
                    <?php echo $pedido['hora_fecha_now']; ?></p>
                <p class="card-text" style="text-align: left;">Estado actual:
                    <?php
                        $consultaEstadoNombre = "SELECT estados.nombre FROM estados_pedidos INNER JOIN estados ON estados_pedidos.id_estado = estados.id_estado WHERE estados_pedidos.id_estado = " . $pedido['id_estado'];
                        $resultadoEstadoNombre = mysqli_query($conexion, $consultaEstadoNombre);
                        foreach ($resultadoEstadoNombre as $estado) {
                            echo $estado['nombre'];
                        }
                        ?>
            </div>
            <div>
                <div class="d-flex align-items-center" style="margin-top: 20px;justify-content: space-evenly;">
                    <div class="mb-2">
                        <button onclick="cambiarEstado(<?php echo $pedido['id_pedido']; ?>, <?php echo $pedido['id_estado']+ 1; ?>)" type="button" class="btn btn-primary btn-sm btn-block">Aceptar</button>
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-danger btn-sm btn-block">Rechazar</button>
                    </div>
                    <div class="mb-2">
                        <a href="descripcionPedido.php?id_pedido=<?php echo $pedido['id_pedido']; ?>&token=<?php echo hash_hmac('sha1', $pedido['id_pedido'], KEY_TOKEN); ?>"
                            class="btn btn-primary btn-sm btn-block">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    function cambiarEstado(idPedido, idEstadoSiguiente) {
    var url = 'functions/actualizar_estado.php?idPedido=' + idPedido + '&idEstadoSiguiente=' + idEstadoSiguiente;
    window.location.href = url;        
    }
</script>
<?php
include('components/footer.php');
?>