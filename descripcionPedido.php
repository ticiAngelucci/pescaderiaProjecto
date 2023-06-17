<?php 
include('components/header.php');
include('components/navbar.php'); 
?>
<div style="display: flex;justify-content: space-around;margin-top:40px;">
    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Pedido</h5>
            <div class="d-flex align-items-center" style="flex-direction: column;">
                <table class="table table-striped table-hover" style="background: white;margin: auto;max-width: 732px;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>eeeeeeeeee</td>
                            <td>e</td>
                            <td>e</td>
                            <td>e</td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-text">
                    <p>Entrega:</p>
                    <p>Total:</p>
                </div>

            </div>
        </div>
    </div>
    <div class="card bg-light">
        <div class="card-body">
            <h5 class="card-title">Estado del Pedido</h5>
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                    style="width: 50px; height: 50px;">
                    <img class="card-img-top" src="assets/flecha.png" alt="Card image cap" style="margin-top:109px;">
                </div>
                <p class="ml-3 mb-0" style="font-size: 18px;">Texto al lado del círculo</p>
            </div>
        </div>
    </div>
</div>

<?php 
include('components/footer.php');
?>