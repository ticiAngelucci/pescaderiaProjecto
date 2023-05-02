@include('header')
@include('navbar')
        <div>
            Catalogo de Productos
        </div>
        <div class="container">
            <div class="row">
                    @foreach($productos as $producto)
                    <div class="card shadow col-3 ">
                        <img src="https://i.ibb.co/XCNWQHD/principal.jpg">
                        <div class="card-body">
                            <h5 class="card-title">{{$producto->nombre}}</h5>
                            <p class="card-text">$ {{$producto->precio_por_gramo}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('detalle',$producto->id_producto)}}" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="#" class="btn btn-success">Agregar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
                <center class="mt-5">
                        {{ $productos->links('paginator') }}
                </center>
        </div>
@include('footer')
