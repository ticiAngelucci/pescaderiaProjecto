<?php 
 include('components/header.php'); 
 include('components/navbar.php'); ?>
<div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">
        <form class="form-horizontal" method="post">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            {!! csrf_field() !!}
            <fieldset>
                <legend>Editar mensaje</legend>
                <div class="form-group">
                    <label for="titulo" class="col-lg-label">Título</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{!!  $producto->nombre !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="descripcion" class="col-lg-label">Contenido</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="contenido"
                            name="descripcion">{!! $producto->descripcion !!}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="precio_por_gramo">Precio por gramo:</label>
                    <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control"
                        placeholder="{!!  $producto->precio_por_gramo !!}">

                </div>
                <div class="form-group">
                    <label for="id_estado_producto">Estado Producto</label>
                    <select id="id_estado_producto" name="id_estado_producto" class="form-select">
                        <option selected>Abrir menu</option>
                        <option value="1">Fresco</option>
                        <option value="2">Congelado</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="cantidad_disponible">Cantidad del Producto en gramos:</label>
                    <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control"
                        placeholder="{!!  $producto->cantidad_disponible !!}">

                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class="btn btn-default">Cancelar</button>
                        <button type="submit" class="ntm btn-primary">Actualizar</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
<?php include('components/footer.php'); ?>