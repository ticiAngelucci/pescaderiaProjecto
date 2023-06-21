<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php'); 
include('functions/pedido.php');

// Verificar si se proporcionó el ID del pedido
if (isset($_GET['id_pedido'])) {
    $idPedido = $_GET['id_pedido'];

    // Obtener los detalles del pedido desde la función getPedido()
    $pedido = getPedido($idPedido);

    // Verificar si se encontró el pedido en la base de datos
    if (!$pedido) {
        // El pedido no se encontró en la base de datos, mostrar un mensaje de error o redirigir a una página de error
        echo "Pedido no encontrado";
        exit;
    }

    // Obtener los detalles del pedido
    $fecha = isset($pedido['fecha']) ? $pedido['fecha'] : '';
    $estado = getEstadoPedido($idPedido); // Reemplaza obtenerEstadoPedido con la función que obtiene el estado del pedido según el id_pedido
    $fechaHora = $fecha;
} else {
    // No se proporcionó el ID del pedido, mostrar un mensaje de error o redirigir a una página de error
    echo "ID del pedido no proporcionado";
    exit;
}
?>

<div class="row justify-content-center text-center">
    <div class="col-md-8 col-lg-6">
        <div class="header" style="color:white;margin-top:30px;">
            <h2>Historial de Pedidos</h2>
            <form method="POST">
                <input type="text" name="busqueda">
                <input type="submit" value="buscar" name="btnbuscar" />
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
    <div class="card">
        <div class="card-header">
            Pedido <?php echo $idPedido; ?>
        </div>
        <div class="card-body">
            <div>
                <h5 class="card-title">El pedido de </h5>
                <p class="card-text" style="text-align: left;">Su compra se realizó el <?php echo $fechaHora; ?></p>
                <p class="card-text" style="text-align: left;">Estado actual: <?php echo $estado; ?></p>
            </div>
            <div>
                <div class="d-flex justify-content-between" style="margin-top:20px;">
                    <button type="button" style="max-width: 150px;width: 100%;" class="btn btn-primary">Aceptar</button>
                    <button type="button" style="max-width: 150px;width: 100%;" class="btn btn-danger">Rechazar</button>
                    <a href="descripcionPedido.php?id_pedido=<?php echo $idPedido; ?>" type="button"
                        style="max-width: 150px;width: 100%;" class="btn btn-secondary">Ver más</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('components/footer.php');
?>