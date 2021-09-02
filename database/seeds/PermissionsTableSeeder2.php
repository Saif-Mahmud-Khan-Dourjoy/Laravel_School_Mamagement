<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //new seeders
        $Permissions = new \App\Permission();
        $Permissions->name="student_Statistics.pdf";
        $Permissions->description="Can dowonload Student Statistics";
        $Permissions->modual="report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="students.create_old";
        $Permissions->description="Can view add form";
        $Permissions->modual="student";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="students.store_old";
        $Permissions->description="Can add old student";
        $Permissions->modual="student";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="blank_result.pdf";
        $Permissions->description="Can dowonload blank result";
        $Permissions->modual="report";
        $Permissions->Save();


        $Permissions = new \App\Permission();
        $Permissions->name="testimonial.pdf";
        $Permissions->description="Can dowonload testimonial";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="studentship-certificate.pdf";
        $Permissions->description="Can dowonload studentship-certificate";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="admit_card.pdf";
        $Permissions->description="Can dowonload admit-card";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="attendance.store";
        $Permissions->description="Can add attendance";
        $Permissions->modual="attendance system";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="attendance.delete";
        $Permissions->description="Can delete attendance";
        $Permissions->modual="attendance system";
        $Permissions->Save();




        



    }
}
