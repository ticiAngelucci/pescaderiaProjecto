@include('header')
@include('navbar')


            <div>
                        <div>
                            Catalogo de Productos
                        </div>
                            @foreach($productos as $producto)
                            <div class="col">
                                <img src="{{$producto->img}}"/>
                                <h4>{{$producto->nombre}}</h4>
                                <h4>Precio:{{$producto->precio_por_gramo}}</h4>
                            </div>
                                <a  href="{{route('detalle',$producto->id_producto)}}">{{__('Mas detalle')}}</a>
                                <button>Agregar carrito</button>
                            @endforeach
                    
                    <center class="mt-5">
                        {{ $productos->links('paginator') }}
                    </center>
            </div>
@include('footer')
