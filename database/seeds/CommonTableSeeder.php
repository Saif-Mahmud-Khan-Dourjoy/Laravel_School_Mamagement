<?php

use Illuminate\Database\Seeder;

class CommonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	//for weekly test report
        // $Permissions = new \App\Permission();
        // $Permissions->name="weeklytests.wt_report";
        // $Permissions->description="Can Search for WT Report";
        // $Permissions->modual="weekly test";
        // $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="weeklytests.viewStudents";
        // $Permissions->description="Can Show Students in WT";
        // $Permissions->modual="weekly test";
        // $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="weeklytests.view_wt_report";
        // $Permissions->description="Can Download WT Report";
        // $Permissions->modual="weekly test";
        // $Permissions->Save();

        //for term result
        // $Permissions = new \App\Permission();
        // $Permissions->name="term_results.searchForTermResult";
        // $Permissions->description="Can search for TR";
        // $Permissions->modual="Term Result";
        // $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="term_results.showStudents";
        // $Permissions->description="Can Show Student in TR";
        // $Permissions->modual="Term Result";
        // $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="section_student.viewAttndance";
        // $Permissions->description="View Daily Attendance";
        // $Permissions->modual="Attendance Report";
        // $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="attendance.pdfAttendanceReport";
        $Permissions->description="Download PDF Attendance";
        $Permissions->modual="Attendance Report";
        $Permissions->Save();

        // $Permissions = new \App\Permission();
        // $Permissions->name="teachers.updateStatus";
        // $Permissions->description="Change Teacher Status";
        // $Permissions->modual="teacher";
        // $Permissions->Save();
    }
}
