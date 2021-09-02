<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionsTableSeeder2::class);
        $this->call(PermissionsTableSeeder3::class);
        $this->call(PermissionTableSeeder4::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(NotificationTypeTableSeeder::class);
        $this->call(MissingTableSeeder::class);


    }
}
