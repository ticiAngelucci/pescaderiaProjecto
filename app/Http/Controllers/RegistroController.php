<?php

namespace App\Http\Controllers;
use App\Models\clientes;
use \DB;

use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function validar(){
        
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
        return view('registro',compact('clientes'));

    }


    public function store(Request $request){
        $clientes = new clientes;
        $clientes->nombre=$request->nombre;
        $clientes->apellido=$request->apellido;
        $clientes->dni=$request->dni;
        $clientes->email=$request->email;
        $clientes->password=$request->password;
        $clientes->id_localidad=$request->id_localidad;        
        $clientes->save();
        return redirect('registro')->with('status','Blog post form data has been inserted');
       
    
    }
}
