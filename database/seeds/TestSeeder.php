<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = new \App\Permission();
        $Permissions->name="terms.index";
        $Permissions->description="Term index";
        $Permissions->modual="Term Result";
        $Permissions->Save();

    }
}
