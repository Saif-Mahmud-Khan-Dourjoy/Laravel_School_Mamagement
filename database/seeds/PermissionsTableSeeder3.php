<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Permissions = new \App\Permission();
        $Permissions->name="generate.student_Statistics";
        $Permissions->description="Can Generate Student Statistics";
        $Permissions->modual="report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="blank_result.searchForTermResult";
        $Permissions->description="Can Generate Blank Result";
        $Permissions->modual="report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="blank_result.generate";
        $Permissions->description="View blank result List";
        $Permissions->modual="report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="testimonial.index";
        $Permissions->description="Can Generate Testimonial";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="studentship.index";
        $Permissions->description="Can Generate Studentship Certificate";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="admitCard.index";
        $Permissions->description="Can Generate admit-card";
        $Permissions->modual="document";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="index.attendance.select.form";
        $Permissions->description="Can View Attendance Form";
        $Permissions->modual="attendance system";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="attendance.dashboard";
        $Permissions->description="Can View Attendance Dashboard";
        $Permissions->modual="attendance system";
        $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="attendance.pdfAttendanceReport";
        // $Permissions->description="Can Download Attendance";
        // $Permissions->modual="report";
        // $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="add.more_edu_info";
        $Permissions->description="Add Educational Qualification";
        $Permissions->modual="teacher";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="add.more_training_info";
        $Permissions->description="Add Training Info";
        $Permissions->modual="teacher";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="add.more_prev_scl_info";
        $Permissions->description="Add Previous School Info";
        $Permissions->modual="teacher";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="add.more_ntrca_info";
        $Permissions->description="Add NTRCA Info";
        $Permissions->modual="teacher";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="add.more_scale_change_info";
        $Permissions->description="Add Scale Changing Info";
        $Permissions->modual="teacher";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="publicExamStore";
        $Permissions->description="Add Public Exam Info";
        $Permissions->modual="student";
        $Permissions->Save();

   
    }
}
