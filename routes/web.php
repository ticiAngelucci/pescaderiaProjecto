<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\CarritoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Rutas de login
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', function () {
    $credencial = request()->only('email', 'password');
    if (Auth::attempt($credencial)) {
        return 'Iniciaste sesion';
    } else {
        return 'Fallo inicio de sesion';
    }
});
//Ruta de Catalogo producto
Route::get('/', "App\Http\Controllers\ProductosController@index");
//Ruta del detalle del producto
Route::get('producto/{id_producto}', [
    'as' => 'detalle',
    'uses' => 'App\Http\Controllers\ProductosController@mostrar'
]);
//RUta para editar producto
Route::get('producto/{id_producto?}/editar', 'App\Http\Controllers\ProductosController@edit')->name('editarProducto');
Route::post('producto/{id_producto?}/editar', 'App\Http\Controllers\ProductosController@update');
//Ruta para quienes somos
Route::get('/quienesSomos', function () {
    return view('quienesSomos');
});
//Ruta editar usuario (solo vista falta agregar id usuario)
Route::get('/editarUsuario', function () {
    return view('editarUsuario');
});


Route::get('/productos', "App\Http\Controllers\MySQlControlador@obtenerProductos");
Route::get('/crearProducto', function () {
    return view('crearProducto');
});
//Ruta para enviar el formulario y crear el producto
Route::post('store-form-producto', 'App\Http\Controllers\ProductosController@store');

//Ruta para ver el registro 
Route::view('/registro', 'registro')->name('registro');
//Route::post('/registro', "App\Http\Controllers\RegistroController@validar");

//Route::post('registro',[RegistroController::class,'validar']);


//Ruta para ver el carrito de compras
Route::view('/carritoCompras', 'carritoCompras');
Route::get('/carrito', 'CarritoController@index')->name('carrito.index');
Route::get('/carritoCompras', 'App\Http\Controllers\CarritoController@index')->name('carrito.index');
Route::post('/carritoCompras/agregar/{id}', 'App\Http\Controllers\App\Http\Controllers\CarritoController@agregar')->name('carrito.agregar');
Route::post('/carritoCompras/eliminar/{id}', 'App\Http\Controllers\CarritoController@eliminar')->name('carrito.eliminar');
Route::post('/carritoCompras/vaciar', 'App\Http\Controllers\CarritoController@vaciar')->name('carrito.vaciar');