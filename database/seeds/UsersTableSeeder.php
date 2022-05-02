<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Role::create(['name' => Role::SUPER_ADMIN]);
		Role::create(['name' => Role::ADMIN]);
		Role::create(['name' => Role::DIRECTOR]);
		Role::create(['name' => Role::INSTRUCTOR]);
		Role::create(['name' => Role::RECLUTAMIENTO]);
		Role::create(['name' => Role::RECURSOS_HUMANOS]);
		Role::create(['name' => Role::USER]);
		Role::create(['name' => Role::ADMIN_GRUPO]);
		Role::create(['name' => Role::CAPTURISTA]);
		Role::create(['name' => Role::PROGRAMADOR_CURSOS]);
		Role::create(['name' => Role::C3]);
		Role::create(['name' => Role::SELECCIONADOR]);
		Role::create(['name' => Role::APROBADO_PUESTO_ACTUAL_C3]);
		Role::create(['name' => Role::APROBADO_PUESTO_ASPIRA_C3]);
		Role::create(['name' => Role::APROBADO_RESTRICCIONES_PUESTO_ACTUAL_C3]);
		Role::create(['name' => Role::APROBADO_RESTRICCIONES_PUESTO_ASPIRA_C3]);
		Role::create(['name' => Role::NO_APROBADO_PUESTO_ASPIRA_C3]);
		Role::create(['name' => Role::NO_APROBADO_PUESTO_ACTUAL_C3]);
		Role::create(['name' => Role::ALUMNO]);
		Role::create(['name' => Role::ASPIRANTE]);
		Role::create(['name' => Role::ACTIVO]);
		Role::create(['name' => Role::CON_REQUISITOS]);
		Role::create(['name' => Role::SIN_REQUISITOS]);
		Role::create(['name' => Role::BAJA_TEMPORAL]);
		Role::create(['name' => Role::BAJA_PERMANENTE]);
		Role::create(['name' => Role::SUSPENCION]);
		Role::create(['name' => Role::DESTITUCION]);

		$user = User::create([
			'name' => 'hexiquio',
			'email' => 'hexiquiogv@email.com',
			'nombre' => 'hexiquio',
			'paterno' => 'gomez',
			'materno' => 'de valle',
			'password' => bcrypt('hexiquiogv@email.com')
		]);
		
		$user->assignRole( Role::SUPER_ADMIN );
		$user->assignRole( Role::ADMIN );

		$user = User::create([
			'name' => 'victor',
			'email' => 'vyxgonzalez@gmail.com',
			'nombre' => 'victor',
			'paterno' => 'gonzalez',
			'materno' => 'mejorado',
			'password' => bcrypt('vyxgonzalez@gmail.com')
		]);

		$user->assignRole( Role::SUPER_ADMIN );
		$user->assignRole( Role::ADMIN );
	}
}