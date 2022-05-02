<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;
use Log;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $route = 'catalogos';
        $parent_id = null;
        if( isset($request['parent_id']) && $request['parent_id'] != 'null'){
            $parent_id = $request['parent_id'];
        }
        $catalogos = Catalogo::where('parent_id',$parent_id)->get();
        $bread_crumbs = self::get_bread_crumbs($parent_id);
        //dd($bread_crumbs);
        return view('catalogos.index', 
            compact('catalogos','parent_id','bread_crumbs','route'));

    }

    public function show(Catalogo $catalogo)
    {
        $current_catalogo = $catalogo->current_catalogo();
        return view('catalogos.show', compact('catalogo','current_catalogo'));
    }

    public function edit(Catalogo $catalogo)
    {
        $route=route('catalogos.update',$catalogo);
        $method = "PUT";
        $title_form='Editar';
        $submitButtonText='Guardar';
        $buttonStyle='btn-success';
        $readonly='';
        $disabled='';

        $current_catalogo = $catalogo->current_catalogo();
        return view('catalogos.form', compact('catalogo','current_catalogo',
            'route','method','title_form','submitButtonText','buttonStyle',
            'readonly','disabled'));
    }

    public function create(Request $request)
    {
        $parent_id = null;
        if( isset($request['parent_id']) && $request['parent_id'] != 'null'){
            $parent_id = $request['parent_id'];
        }
        $catalogo = new Catalogo;
        $catalogo->parent_id = $parent_id;
        $current_catalogo = $catalogo->current_catalogo();

        $route=route('catalogos.store');
        $method = "POST";
        $title_form='Crear';
        $submitButtonText='Guardar';
        $buttonStyle='btn-success';
        $readonly='';
        $disabled='';

        return view('catalogos.form', compact('catalogo','current_catalogo',
            'route','method','title_form','submitButtonText','buttonStyle',
            'readonly','disabled'));
    }

    public function store(Request $request)
    {
        // validate
        $this->validate(request(), [
            'name' => 'required'           
        ]);
        $parent_id = null;
        if( isset($request['parent_id']) && $request['parent_id'] != 'null'){
            $parent_id = $request['parent_id'];
        }
        $catalogo = new Catalogo;
        $catalogo->parent_id = $parent_id;
        $catalogo->name = $request->name;
        $catalogo->save();

        return redirect( route('catalogos.index',"parent_id=".$catalogo->parent_id) )
                    ->with('info', 'Elemento guardado con éxitosamente');
    }

    public function update(Request $request, Catalogo $catalogo) {
        // validate
        $this->validate(request(), [
            'name' => 'required'           
        ]);

        // store
        $catalogo->name = request('name');
        $catalogo->save();
        
        return redirect()->route('catalogos.index',"parent_id=".$catalogo->parent_id)
                    ->with('info', 'Elemento actualizado con éxito');
    }

    public function destroy($catalogo_id) {
        $catalogo = Catalogo::find($catalogo_id);
        if (isset($catalogo)) {
            $catalogo->delete();
            return back()->with('info', 'El elemento fué eliminado con éxito.');
        } else {
            return back()->with('error', 'No pudo efectuarse la eliminación del elemento.');
        }
    }

    public function apiGetCatalogo(Request $request, $catalogo_nombre)
    {
        Log::debug("cargando catalogo $catalogo_nombre");
        $results = [];
        $items = [];
        switch ($catalogo_nombre) {
            case 'coahuila':
                $items = Estado::find(5)->municipios;
                break;
            case 'si_no':
                $results = [
                        ["name"=>"Si","id"=>1],
                        ["name"=>"No","id"=>0]
                ];
                break;
            default:
                if (is_numeric($catalogo_nombre)){
                    $items=Catalogo::find($catalogo_nombre)->items;
                } else {
                    $items=Catalogo::catalogos($catalogo_nombre)->first()->items;    
                }
                
                break;
        }
        
        //dd($items);
        foreach ($items as $item) {
            $results[] = ["name" => $item->nombre, "id" => $item->id]; 
        }
        
        if($request->ajax()){
            return response()->json([
                'status' => 'ok',
                'data' => $results
            ]);
        }

        return $results;
    }

    public function get_bread_crumbs($parent_id=null, $reverse=true){
        $catalogo = Catalogo::find($parent_id);
        $results = [];
        while ($catalogo){
            $results[ucfirst($catalogo->name)] = "parent_id=".$catalogo->id;
            $catalogo = $catalogo->parent;
        }
        $results["Catalogos"] = "parent_id=null";
        if ($reverse) $results = array_reverse($results);
        return $results;
    }  
}
