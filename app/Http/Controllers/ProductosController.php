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
}