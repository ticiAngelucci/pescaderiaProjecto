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
Route::get('/', "App\Http\Controllers\ProductosController@index");
Route::get('producto/{id}', [
    'as' => 'detalle',
    'uses' => 'ProductosController@mostrar'
]);
Route::get('/quienesSomos', function () {
    return view('quienesSomos');
});
Route::get('/editarUsuario', function () {
    return view('editarUsuario');
});


Route::get('/productos', "App\Http\Controllers\MySQlControlador@obtenerProductos");
Route::get('/crearProducto', function () {
    return view('crearProducto');
});
Route::post('store-form', [ProductosController::class, 'store']);


Route::view('/registro', 'registro')->name('registro');
//Route::post('/registro', "App\Http\Controllers\RegistroController@validar");

//Route::post('registro',[RegistroController::class,'validar']);
Route::post('store-form',[RegistroController::class,'store']);
