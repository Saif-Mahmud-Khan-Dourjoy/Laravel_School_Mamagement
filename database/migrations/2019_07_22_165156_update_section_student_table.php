<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateSectionStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::delete('delete from section_students');

        DB::update('update section_students set roll=(select roll_no from students where id=section_students.student_id) where id !=0');
        DB::table('students')->update(['roll_no' => 0]);
        Schema::table('section_students', function (Blueprint $table) {
            $table->unique(['section_id','student_id']);
            $table->unique(['section_id','roll']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update('update students set roll_no=(select roll from section_students where student_id=students.id) where id !=0');
        Schema::table('section_students', function (Blueprint $table) {
            $table->dropUnique('section_students_section_id_student_id_unique');
            $table->dropUnique('section_students_section_id_roll_unique');
        });
    }
}
