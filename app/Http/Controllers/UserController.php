<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

use App\User;
use App\Models\Role;

use Auth;


class UserController extends Controller
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
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::permitedRoles()->get();
        $user = new User;
        $route = route('users.store');
        $method = "post";
        $title = "Usuarios - Nuevo registro";
        $readonly = "";
        $disabled = "";
        return view('admin.users.form', 
                compact('user','title','route','method','readonly','disabled'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->nombre = $request['nombre'];
        $user->paterno = $request['paterno'];
        $user->materno = $request['materno'];
        $user->password = bcrypt("12345678");
        $user->save();
        //$roles = $request['roles'];
        //$user->assignRole(Role::ADMIN);
        //$user->assignRole('usuario');

        return redirect()->route('users.index')
                    ->withSuccess('El usuario fué creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::permitedRoles()->get();
        $route = "users";
        return view('admin.users.form', compact('user', 'roles','route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::permitedRoles()->get();
        $route = route('users.update',$user->id);
        $method = "patch";
        $title = "Usuarios - Editando registro (".$user->id.")";
        $readonly = "";
        $disabled = "";
        return view('admin.users.form', 
                compact('user','roles','title','route','method','readonly',
                    'disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();
        $input = $request->only(['name', 'email', 'nombre','paterno','materno']);
        $user->update($input);

        $roles = $request['roles'];

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
    
        return redirect()->route('users.index')
                    ->withSuccess('El usuario fué actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->withSuccess('El usuario fué eliminado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apiUpdatePassword(Request $request)
    {
        $rules = [
            'password' => 'required',
            'new_password' => 'required|confirmed'
        ];

        if (isset($request->item_id) && $request->item_id > 0)
            unset($rules['password']);
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails ()) {
            return Response::json ( array (
                    'errors' => $validator->errors()->all()
            ) );
        } else {
            $cliente = Auth::user();
            if (isset($rules['password'])) {
                if (!Hash::check($request->password, Auth::user()->getAuthPassword())) {
                    return Response::json ( array (
                        'errors' => 'La contraseña actual no es correcta'
                    ));
                }
            } else {
                $cliente = User::find($request->item_id);
            }
            
            $cliente->Password = bcrypt($request->new_password);
            $cliente->save();
            return Response::json ( array (
                    'info' => 'La contraseña fué actualizada'
                ));
        }
    }

    public function reset_pwd(User $user){
        if (!Auth::user()->hasRole([Role::ADMIN ,Role::SUPER_ADMIN])) 
            return back()->withErrors('No tiene permisos para modificar contraseñas de usuarios');

        $user->password = bcrypt("12345678");
        $user->save();

        return back()->withSuccess('La contraseña de usuario '.$user->name.' fué re-iniciada');        
    }

}
