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


    public function store(Request $request){
        $post = new Post;
        $post->nombre=$request->nombre;
        $post->apellido=$request->apellido;
        $post->dni=$request->dni;
        $post->email=$request->email;
        $post->password=$request->password;
        $post->save();
        return redirect('registro'->with('status','Blog post form data has been inserted'));
       // $nombre=request('nombre');
        //$apellido=request('apellido');
        //$dni=request('dni');
        //$email=request('email');
        //$password=request('password');
        
    }
}
