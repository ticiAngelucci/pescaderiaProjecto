<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('catalogo');
});
Route::get('/editarUsuario', function () {
    return view('editarUsuario');
});

Route::get('/productos', "App\Http\Controllers\MySQlControlador@obtenerProductos");
Route::view('/registro','registro')->name('registro');
Route::post('/registro', "App\Http\Controllers\RegistroCliente@registrarCliente");
Route::post('/registro/EXITOSO','App\Http\Controllers\RegistroCliente@store')->name('RegistroCliente.store');