<?php include('components/header.php'); ?>
<?php include('components/navbar.php'); ?>
<div class="container">
    <h4 class="d-flex justify-content-center mt-5 display-5">Crear producto!</h4>
    <form name="crearProductoForm" id="crearProductoForm" method="post" action="#">
        <div class="row g-2 py-5">
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="merluza">
                    <label for="nombre">Nombre del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                        placeholder="descripcion de producto">
                    <label for="descripcion">Descripcion del Producto:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <select id="id_categoria" name="id_categoria" class="form-select">
                        <!-- Hacer dinamicos los option cuando carguemos categorias por ahora estatico -->
                        <option value="1">Rebozado</option>
                        <option value="2">Mariscos</option>
                        <option value="3">Entero</option>
                    </select>
                    <label for="id_categoria">Categoria Producto</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control"
                        placeholder="20">
                    <label for="precio_por_gramo">Precio por gramo:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <select id="id_estado_producto" name="id_estado_producto" class="form-select">
                        <option selected>Abrir el menu</option>
                        <option value="1">Fresco</option>
                        <option value="2">Congelado</option>
                    </select>
                    <label for="id_estado_producto">Estado Producto</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control"
                        placeholder="20">
                    <label for="cantidad_disponible">Cantidad del Producto en gramos:</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar!</button>
    </form>
</div>
<?php include('components/footer.php'); ?>