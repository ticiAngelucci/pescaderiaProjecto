<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use \DB;

class ProductosController extends Controller
{
    
    public function index()
    {
        $productos = Productos::paginate(8);
        return view('catalogo', compact('productos'));
    }
    public function store(Request $request)
    {
        $productoNuevo = new Productos;
        $productoNuevo->nombre = $request->nombre;
        $productoNuevo->id_categoria = $request->id_categoria;
        $productoNuevo->precio_por_gramo = $request->precio_por_gramo;
        $productoNuevo->id_estado_producto = $request->id_estado_producto;
        $productoNuevo->cantidad_disponible = $request->cantidad_disponible;
        $productoNuevo->descripcion = $request->descripcion;
        $productoNuevo->save();
        return redirect('crearProducto')->with('status', 'Producto agregado!');
    }
    public function mostrar($id_producto)
    {
        $producto = Productos::where('id_producto', $id_producto)->first();
        return view('detalleProducto', ["producto" => $producto]);
    }
    public function edit($id_producto)
    {
        $producto = Productos::where('id_producto', $id_producto)->first();
        return view('editarProducto', compact('producto'));
    }
    public function update(Request $request, $id_producto)
    {

        $producto = Productos::whereId_producto($id_producto)->firstOrFail();
        print($producto);
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio_por_gramo = $request->get('precio_por_gramo');
        $producto->cantidad_disponible = $request->get('cantidad_disponible');
        $producto->id_estado_producto = $request->get('id_estado_producto');

        $producto->save();
        return redirect(action('App\Http\Controllers\ProductosController@edit', $producto->id_producto))->with('El mensaje ' . $id_producto . ' ha sido actualizado');
    }
    //Para carrito
    public function mostrarProductos()
{
    // Obtener los datos del carrito y asignarlos a la variable $carrito
    $carrito = 

    // Pasar la variable $carrito a la vista
    return view('productos')->with('carrito', $carrito);
}

 


}