<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder4 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = new \App\Permission();
        $Permissions->name="term_results.showStudents";
        $Permissions->description="Show Student List";
        $Permissions->modual="Term Result";
        $Permissions->Save();
       
        $Permissions = new \App\Permission();
        $Permissions->name="term_results.viewAll";
        $Permissions->description="Submit Form";
        $Permissions->modual="Term Result";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="term_results.single-view";
        $Permissions->description="Submit Single Result";
        $Permissions->modual="Term Result";
        $Permissions->Save();


        $Permissions = new \App\Permission();
        $Permissions->name="term_results.viewStudents";
        $Permissions->description="Studunt Result List";
        $Permissions->modual="Term Result";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="teachers.updateStatus";
        $Permissions->description="Change Teacher Status";
        $Permissions->modual="teacher";
        $Permissions->Save();

        
    }
}
