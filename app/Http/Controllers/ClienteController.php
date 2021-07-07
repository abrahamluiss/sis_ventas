<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct(){

    }


    public function index(Request $request){
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $personas=DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Cliente')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Cliente')
            ->orderBy('idpersona','desc')
            ->paginate(7);
            return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }

    public function store(PersonaFormRequest $request){
        $persona = new Persona;
        $persona->tipo_persona='Cliente';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');

        $persona->save();
        return redirect('ventas/cliente');
    }

    public function create(){
        return view('ventas.cliente.create');
    }

    public function edit($id){
        $persona = Persona::findOrFail($id);
        return view("ventas.cliente.edit",["persona"=>$persona]);
    }

    public function update(PersonaFormRequest $request,$id){
        $persona=Persona::findOrFail($id);

        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');
        $persona->update();
        return redirect('ventas/cliente');
    }

     public function destroy($id)
    {
        Persona::destroy($id);
        return redirect('ventas/cliente');
    }

    public function show($id)
    {
        return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
    }
}
