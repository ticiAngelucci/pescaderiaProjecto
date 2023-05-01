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

    public function index(Request $request){
        $clientes=clientes::all();
        return view('google.com',compact('clientes'));

    }


    public function store(){
        $nombre=$request('nombre');
        $apellido=$request('apellido');
        $dni=$request('dni');
        $email=$request('email');
        $password=$request('password');
        
    }
}
