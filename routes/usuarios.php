<?php

use App\User;
use App\Models\Role;
use App\Models\ServicioSupervisor;
use Illuminate\Http\Request;

Route::middleware(['roles'=>'role:admin|super_admin|director'])->group(function () {
	// Roles
	Route::resource('roles', 'RoleController');
	Route::get('roles/{role}/delete', 'RoleController@destroy')
		->name('roles.delete');
	Route::match(['get', 'post'],'list.roles', function(Request $request) {
		$items = Role::query();

		return DataTables::eloquent($items)
		        ->addColumn('acciones', function($item){ 
					$btn_editar = route('roles.edit',$item->id);
					$btn_eliminar= route('roles.delete',$item->id);

					$action_buttons = "
					<div class='row'>
						<a href='$btn_editar' class='px-1' title='Editar'>
							<span class='badge badge-warning text-white shadow'>
								<i class='fa fa-pencil fa-2x'></i>
							</span>
						</a>

						<a href='$btn_eliminar' class='px-1' title='Eliminar'>
							<span class='badge badge-danger text-white shadow'>
								<i class='fa fa-trash fa-2x'></i>
							</span>
						</a>
					</div>	
					";
					
	                return $action_buttons;
	            })
	            ->make(TRUE);
	})->name('list.roles');

	// Usuarios
    Route::resource('users', 'UserController');    
    Route::get('users/{user}/delete', 'UserController@destroy')
    	->name('users.delete');
    Route::get('users/{user}/reset_pwd', 'UserController@reset_pwd')
    	->name('users.reset_pwd');
    Route::post('update_password', 'UserController@apiUpdatePassword');
	Route::match(['get', 'post'],'list.users', function(Request $request) {
		$user_ids = [];
		if (Auth::user()->hasRole(Role::ADMIN)){
			$user_ids[] = Auth::id();
			array_push($user_ids, User::has('roles')->pluck('id')->toArray());
		}
		if (Auth::user()->hasRole(Role::SUPER_ADMIN)){
			$user_ids = [];
		}
		$items = User::query()
						//->has('roles') // con algun role
						//->wherewithCount('roles')->has('roles', 0) // ningun role
						->whereNotIn('id',$user_ids);

		return DataTables::eloquent($items)
		        ->addColumn('acciones', function($item){ 
					$btn_editar = route('users.edit',$item->id);
					$btn_pwd= route('users.reset_pwd',$item->id);;
					$btn_eliminar= route('users.delete',$item->id);

					$action_buttons = "
					<div class='row d-flex justify-content-around p-1'>
						<a href='$btn_editar' class='px-1' title='Editar'>
							<span class='badge badge-warning text-white shadow'>
								<i class='fa fa-pencil fa-2x'></i>
							</span>
						</a>
						<a href='$btn_pwd' class='px-1' title='Contraseña'>
							<span class='badge badge-info text-white shadow'>
								<i class='fa fa-lock fa-2x'></i>
							</span>
						</a>
						<a href='$btn_eliminar' class='px-1' title='Eliminar'>
							<span class='badge badge-danger text-white shadow'>
								<i class='fa fa-trash fa-2x'></i>
							</span>
						</a>
					</div>	
					";
					
	                return $action_buttons;
	            })
	            ->make(TRUE);
	})->name('list.users');

	Route::match(['get', 'post'],'users_list', function() {
		$data = [];
		foreach(User::get() as $user){
			$data[] = [
				'id'=>$user->id,
				'name'=>$user->fullname
			];
		}
	    return response()->json([
	        'status' => 'ok',
	        'data' => $data
	    ]);
	})->name('users_list');  

	Route::match(['get', 'post'],'supervisores/{servicio}', function($servicio) {
		
		$supervisores_ids_asignados = 
			ServicioSupervisor::getSupervisorsByService($servicio)
			->pluck('user_id')->toArray();

		$candidatos = 
			User::whereHas("roles", function($q){ $q->where("name", Role::SUPERVISOR); })
				->whereNotIn('id',$supervisores_ids_asignados)
				->get();

		$data = [];
		foreach($candidatos as $user){
			$data[] = [
				'id'=>$user->id,
				'name'=>$user->fullname
			];
		}
		
	    return response()->json([
	        'status' => 'ok',
	        'data' => $data
	    ]);
	})->name('supervisores');   

	Route::match(['get', 'post'],'/usuarios_by_role/{role_name}', function($role_name) {
		$role = Role::where('name',$role_name)->first();		
		$data = [];
		if (!is_null($role)){
			$users = User::whereHas("roles", function($q) use ($role) { $q->where("name", $role->name); })
							->orderBy('paterno', 'asc')
							->orderBy('materno', 'asc')
							->orderBy('nombre', 'asc')
							->get();
			foreach ($users as $user) {
				$data[] = [
					'name' 	=> $user->fullname,
					'id'	=> $user->id
				];
			}
		}
	    return response()->json([
	        'status' => 'ok',
	        'data' => $data
	    ]);
	})->name('usuarios_by_role');  
});