<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roles = Role::all();

		$admin = User::where('id', '=', 1)->first();
		$admin->roles()->attach(1);

		$roles = Role::where('id','!=','1')->get();
		User::all()->each(function ($user) use ($roles) {
			$roles->forget(1);
			$user->roles()->attach(
				$roles->random()->pluck('id')
			);
		});
	}
}
