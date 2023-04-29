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
    public function registrarCliente(){
        
        request()->validate([
         'nombre'->required,
         'apellido'->required,
         'dni'->required,
         'email'->required,
         'password'->required
         
        ]);
        return 'Registro exitoso';
    }
}