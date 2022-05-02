<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;
use Validator;

class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $catalogo)
    {
    	$name = $catalogo;
    	$route = route('list.create',$catalogo);
        return view('lists.index',compact('route','name'));
    }

    public function create($catalogo)
    {
    	$parent = Catalogo::find_by_name($catalogo)->first();
        $registro = new Catalogo;
        $registro->parent_id = $parent->id;
        $name = $parent->name;
        $route = route('list.store',$parent->id);
        $method = "post";
        $title = "$name - Nuevo registro";
        return view('lists.form', 
        		compact('registro','title','route','method','name'));
    }

	public function store(Request $request, Catalogo $catalogo)
    {
    	Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();
    	
        $registro = new Catalogo;
        $registro->parent_id = $catalogo->id;
        $registro->name = $request->name;
        $registro->save();

        return redirect()->route('list.index',$catalogo->name)
                    ->withSucess('Se guardó nuevo registro para '.
                    	$catalogo->name." ".$registro->name);
    }

    public function edit(Request $request, Catalogo $catalogo)
    {
        $name = $catalogo->parent->name;
        $registro = $catalogo;
        $route = route('list.update',$catalogo->id);
        $method = "patch";
        $title = "$name - Edición registro (".$catalogo->id.")";

        return view('lists.form', 
        		compact('registro','title','route','method','name'));
    }

    public function update(Request $request, Catalogo $catalogo)
    {
    	Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();
    	
        $catalogo->update($request->only('name'));

        return redirect()->route('list.index',$catalogo->parent->name)
                    ->withSucess('Se guardó cambio para '.
                    	$catalogo->parent->name." ".$catalogo->name);
    }

    public function delete(Catalogo $catalogo)
    {
        $name = $catalogo->parent->name;
        $catalogo_name = $catalogo->name;
        $catalogo->delete();

        return redirect(route('list.index',$name))
                    ->withSucess("Se eliminó $name $catalogo_name");
    }
}
