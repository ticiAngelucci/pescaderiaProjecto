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

    public function store(Request $request){
        $clientes= new Clientes;
        $clientes->nombre=$request->input('nombre');
        $clientes->apellido=$request->input('apellido');
        $clientes->dni=$request->input('dni');
        $clientes->email=$request->input('email');
        $clientes->password=$request->input('password');
        
        $clientes->save();
        return redirect()->route('http://127.0.0.1:8000/');
    }
}
