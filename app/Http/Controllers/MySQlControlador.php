<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use \DB;

class MySQlControlador extends Controller
{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
    public function obtenerProductos(){
        return productos::all();
    }
    public function crearProductos(Request $request){
        $productoNuevo = new productos;
        $productoNuevo->nombre = $request->producto;
        $productoNuevo->id_categoria = $request->id_categoria;
        $productoNuevo->precio_por_gramo = $request->precio;
        $productoNuevo->save();
        return back()->with('mensaje','Producto agregado');
    }
}