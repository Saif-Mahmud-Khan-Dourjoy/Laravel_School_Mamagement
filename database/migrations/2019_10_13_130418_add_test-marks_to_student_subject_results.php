<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestMarksToStudentSubjectResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_subject_results', function (Blueprint $table) {
             $table->integer('wt_mark')->after('weekly_test_marks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_subject_results', function (Blueprint $table) {
            $table->dropColumn('wt_mark');
        });
    }
}
