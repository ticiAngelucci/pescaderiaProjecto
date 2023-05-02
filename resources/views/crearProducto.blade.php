@include('header')
@include('navbar')
        <div class="container">
            <div class="card-body">
      <form name="crearProductoForm" id="crearProductoForm" method="post" action="{{url('store-form')}}">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Nombre Producto</label>
          <input type="text" id="nombre" name="nombre" class="form-control" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Id categoria producto</label>
          <input type="number" id="id_categoria" name="id_categoria" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">ppg</label>
          <input type="number" id="precio_por_gramo" name="precio_por_gramo" class="form-control" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">id_estado_producto</label>
          <input type="number" id="id_estado_producto" name="id_estado_producto" class="form-control" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">cantidad_disponible</label>
          <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="cantidad_disponible" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
        </div>
@include('footer')
