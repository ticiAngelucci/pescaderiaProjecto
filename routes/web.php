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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', "App\Http\Controllers\MySQlControlador@obtenerProductos");
Route::view('/registro','registro')->name('registro');
Route::post('/registro', "App\Http\Controllers\RegistroCliente@registrarCliente");