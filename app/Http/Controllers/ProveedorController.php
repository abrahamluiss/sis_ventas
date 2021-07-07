<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
   public function __construct(){

    }


    public function index(Request $request){
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $personas=DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Proveedor')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Proveedor')
            ->orderBy('idpersona','desc')
            ->paginate(7);
            return view('compras.proveedor.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }

    public function store(PersonaFormRequest $request){
        $persona = new Persona;
        $persona->tipo_persona='Proveedor';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');
        $persona->telefono=$request->get('telefono');

        $persona->save();
        return redirect('compras/proveedor');
    }

    public function create(){
        return view('compras.proveedor.create');
    }

    public function edit($id){
        $persona = Persona::findOrFail($id);
        return view("compras.proveedor.edit",["persona"=>$persona]);
    }

    public function update(PersonaFormRequest $request,$id){
        $persona=Persona::findOrFail($id);

        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');
        $persona->update();
        return redirect('compras/proveedor');
    }

     public function destroy($id)
    {
        Persona::destroy($id);
        return redirect('compras/proveedor');
    }

    public function show($id)
    {
        return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
    }
}
