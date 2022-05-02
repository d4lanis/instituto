<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Config;
use Auth;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        $route = route('roles.store');
        $method = "post";
        $title = "Role - Nuevo registro";
        $readonly = "";
    	$disabled = "";
        return view('admin.roles.form', 
        		compact('role','title','route','method','readonly','disabled'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
    	$validated = $request->validated();
    	$input = $request->only(['name']);
        $role = new Role($input);
        $role->guard_name = "";
        $role->save();

        return redirect()->route('roles.index')
                    ->withSucess('El registro fué almacenado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $route = "";
        $method = "";
        $title = "Role - Detalle registro (".$role->id.")";
        $readonly = "readonly";
    	$disabled = "disabled";
        return view('admin.roles.form', 
        		compact('role','title','route','method','readonly','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
    	$route = route('roles.update',$role->id);
        $method = "patch";
    	$title = "Role - Editando registro (".$role->id.")";
    	$readonly = "";
    	$disabled = "";
        return view('admin.roles.form', 
        		compact('role','title','route','method','readonly','disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
    	$validated = $request->validated();
    	$input = $request->only(['name']);
    	$role->update($input);

    	return redirect()->route('roles.index')
                    ->withSuccess('El registro fué actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

    	return back()->withSuccess('El registro fué eliminado');
    }
}
