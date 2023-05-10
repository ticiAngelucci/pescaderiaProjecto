<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegistroController;
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

//Ruta para registrar una persona
Route::view('/registro', 'registro')->name('registro');

//Route::post('/registro', "App\Http\Controllers\RegistroController@validar");

//Route::post('registro',[RegistroController::class,'validar']);
Route::post('store-form',[RegistroController::class,'store']);
