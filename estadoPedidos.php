<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/header.php');
include('components/navbar.php'); 
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
    <div class="card">

        <div class="card-header">
            Pedido *inserte numero de pedido*
        </div>
        <div class="card-body">
            <div>
                <h5 class="card-title">El pedido de *inserte nombre*</h5>
                <p class="card-text" style="text-align: left;">Su compra se retira *inserte fecha y hora de la compra
                    para retirar*</p>
                <p class="card-text" style="text-align: left;">Su estado actual es *inserte estado de pedido*</p>

            </div>
            <div>
                <div class="d-flex justify-content-between" style="margin-top:20px;">
                    <button type="button" style="max-width: 150px;width: 100%;" class="btn btn-primary">Aceptar</button>
                    <button type="button" style="max-width: 150px;width: 100%;" class="btn btn-danger">Rechazar</button>
                    <button href="descripcionPedido.php" type="button" style="max-width: 150px;width: 100%;"
                        class="btn btn-secondary">Ver más</button>
                </div>
            </div>
        </div>
    </div>
    <div>






        <?php 
include('components/footer.php');
?>