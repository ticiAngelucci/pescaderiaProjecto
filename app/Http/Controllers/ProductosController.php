<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use \DB;

class ProductosController extends Controller
{
    public function index()
    {
        return view('crearProducto');
    }
    public function store(Request $request)
    {
        $productoNuevo = new Productos;
        $productoNuevo->nombre = $request->nombre;
        $productoNuevo->id_categoria = $request->id_categoria;
        $productoNuevo->precio_por_gramo = $request->precio_por_gramo;
        $productoNuevo->id_estado_producto = $request->id_estado_producto;
        $productoNuevo->cantidad_disponible = $request->cantidad_disponible;
        $productoNuevo->save();
        return redirect('crearProducto')->with('status', 'Producto agregado!');
    }
}
