<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index()
    {
        return Persona::all(['nombre', 'email']);
    }

}
