<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';
    protected $primaryKey = 'idarticulo';
    public $timestamps=false;
    protected $fillable=[
    	'nombre',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'image',
    	'estado'
    ];
    protected $guarded=[
    	
    ];
}
