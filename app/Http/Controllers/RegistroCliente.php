<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registroCliente extends Controller
{
    public function registrarCliente(){
        
        request()->validate([
         'nombre' => 'required',
         'apellido' => 'required',
         'dni' => 'required',
         'email' => 'required',
         'password' => 'required'
         
        ]);
        return 'Registro exitoso';
    }
}
