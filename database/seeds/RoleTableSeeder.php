<?php

use Illuminate\Database\Seeder;
use KawsarJoy\RolePermission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
		    'name' => 'Admin',
		    'description' => 'Admin User',
		]);
    }
}
