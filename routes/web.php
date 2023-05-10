<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;

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
//Ruta para quienes somos
Route::get('/quienesSomos', function () {
    return view('quienesSomos');
});
//Ruta editar usuario (solo vista falta agregar id usuario)
Route::get('/editarUsuario', function () {
    return view('editarUsuario');
});
//RUta para la vista de crear producto
Route::get('/crearProducto', function () {
    return view('crearProducto');
});
//Ruta para enviar el formulario y crear el producto
Route::post('store-form', [ProductosController::class, 'store']);
//Ruta de registro view
Route::view('/registro', 'registro')->name('registro');
Route::post('/registro', "App\Http\Controllers\RegistroCliente@registrarCliente");
Route::post('registro/exitoso', 'App\Http\Controllers\RegistroCliente@store')->name('RegistroCliente.store');