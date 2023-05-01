<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    use HasFactory;
    protected $table="clientes";
    protected $primaryKey="id_cliente";
    protected $fillable =['nombre','apellido','dni','id_localidad','email','password'];


}
