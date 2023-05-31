<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Cart;
class CarritoController extends Controller
{
public function index()
{
    $carrito = session('carrito', []);

    return view('carritoCompras', compact('carrito'));
}



public function agregar($id)
{
    $productos = Productos::findOrFail($id);

    $carrito = session('carrito', []);
    $carrito[$id] = $productos;

    session(['carrito' => $carrito]);

    return redirect()->route('carrito.index');
}

public function eliminar($id)
{
    $carrito = session('carrito', []);

    if (isset($carrito[$id])) {
        unset($carrito[$id]);
        session(['carrito' => $carrito]);
    }

    return redirect()->route('carrito.index');
}

public function vaciar()
{
    session(['carrito' => []]);

    return redirect()->route('carrito.index');
}

}