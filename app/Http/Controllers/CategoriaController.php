<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoriaFormRequest;

class CategoriaController extends Controller
{
    public function __construct(){

    }


    public function index(Request $request){
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categoria=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where ('condicion','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categoria"=>$categoria,"searchText"=>$query]);
        }
    }

    public function store(CategoriaFormRequest $request){
        $categoria = new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return redirect('almacen/categoria');
    }

    public function create(){
        return view('almacen.categoria.create');
    }

    public function edit($id){
        $categoria = Categoria::findOrFail($id);
        return view("almacen.categoria.edit",["categoria"=>$categoria]);
    }

    public function update(CategoriaFormRequest $request,$id){
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return redirect('almacen/categoria');
    }

     public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect('almacen/categoria');
    }

    public function show($id)
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    }
